<x-layouts.app :title="$title">
    <section class="main">
        <div class="container">
            <div class="wrapper">
                <h2 class="wrapper__title">
                    {{$title}}
                </h2>

                {{$slot}}
                
            </div>
        </div>
    </section>  
</x-layouts.app>