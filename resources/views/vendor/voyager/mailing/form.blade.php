
@extends('voyager::master')

@section('page_title', 'Mailing')

@section('content')
    <h1 class="mb-4">Mailing</h1>

    <form action="{{ route('mailing.form.preview') }}">
        @csrf

        <div class="form-group">
        <label for="userSelect">Recipient</label>
<select class="form-control" id="userSelect" name="recipient">
    <optgroup label="User search">
        <option value="all">All users</option>
        <option value="verified">Verified users</option>
    </optgroup>
    <optgroup label="Having Active Subscription To:">
        @if ($products && $products->count() > 0)
            @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->productable?->title ?? '' }} ({{ $product->subscriptions()->count() }})</option>
            @endforeach
        @endif
    </optgroup>
</select>
        </div>

        <div class="form-group">
            <label for="layoutSelect">Layout</label>
            <select class="form-control" id="layoutSelect" name="layout">
                <option value="user">User</option>
                <option value="new-product">New product</option>
                <option value="discounts">Discounts</option>
                <option value="new-article">New article</option>
            </select>
        </div>

        <div class="form-group" id="productSelectContainer"></div>
        <div class="form-group" id="discountsSelectContainer"></div>
        <div class="form-group" id="articleLinkContainer"></div>

        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject" placeholder="Mail subject...">
        </div>

        <textarea id="htmlContent" name="htmlContent"></textarea>

        <button type="submit" class="btn btn-primary">Send</button>
    </form>

    <template id="productOptions">
        @foreach ($products as $product)
            <option value="{{ $product->id }}">{{ $product->productable->title ?? '' }}</option>
        @endforeach
    </template>

    <template id="discountsOptions">
    @forelse ($discounts ?? [] as $discount)
        <option value="{{ $discount->id }}">{{ $discount->productable->name ?? '' }}</option>
    @empty
        <option disabled>No Discounts Available</option>
    @endforelse
</template>

    <template id="articleOptions">
        <input type="text" name="link" class="form-control" placeholder="Link...">
    </template>

    <div style="display: flex; justify-content: center; margin: 100px 0 20px;">
        {{ $emails->links('pagination::bootstrap-4') }}
    </div>

    <table class="table table-striped table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($emails as $email)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $email->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <a href="{{ route('mailing.show', $email->id) }}" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @push('javascript')
       <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

        <script>
            CKEDITOR.replace('htmlContent');
            document.addEventListener('DOMContentLoaded', function() {
                var layoutSelect = document.getElementById('layoutSelect');
                var productSelectContainer = document.getElementById('productSelectContainer');
                var discountsSelectContainer = document.getElementById('discountsSelectContainer');
                var articleLinkContainer = document.getElementById('articleLinkContainer');
                var subjectContainer = document.getElementById('subject').parentNode;

                layoutSelect.addEventListener('change', function() {
                    var selectedValue = this.value;
                    productSelectContainer.innerHTML = '';
                    discountsSelectContainer.innerHTML = '';
                    articleLinkContainer.innerHTML = '';

                    if (selectedValue === 'new-product') {
                        var select = document.createElement('select');
                        select.className = 'form-control';
                        select.name = 'product_id';
                        select.innerHTML = document.getElementById('productOptions').innerHTML;
                        productSelectContainer.appendChild(select);
                    } else if (selectedValue === 'discounts') {
                        var discountSelect = document.createElement('select');
                        discountSelect.setAttribute('multiple', 'multiple');
                        discountSelect.className = 'form-control';
                        discountSelect.name = 'discounts[]';
                        discountSelect.innerHTML = document.getElementById('discountsOptions').innerHTML;
                        discountsSelectContainer.appendChild(discountSelect);
                        $(discountSelect).select2();
                    } else if (selectedValue === 'new-article') {
                        articleLinkContainer.innerHTML = document.getElementById('articleOptions').innerHTML;
                    }
                });
            });
        </script>
    @endpush
@endsection
