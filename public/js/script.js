document.addEventListener("DOMContentLoaded", function () {
  function activate(elements, trigger) {
    trigger.forEach((elem, i) => {
      elem.addEventListener("click", () => {
        if (!elements[i]) return;

        elements[i].classList.toggle("active");
      });
    });
  }

  function activateDrop(elements, trigger) {
    activate(elements, trigger);
    trigger.forEach((el, i) => {
      el.addEventListener("click", () => {
        const arrow = el.querySelector(".arrow");

        if (arrow) {
          const counter = arrow.style.transform.substring(7, 10);

          if (counter == "180") {
            el.querySelector(".arrow").style.transform = `rotate(${0}deg)`;
          } else {
            el.querySelector(".arrow").style.transform = `rotate(${180}deg)`;
          }
        }
        if (!elements[i]) return;
        if (elements[i].style.maxHeight) {
          elements[i].style.maxHeight = null;
        } else {
          elements[i].style.maxHeight = elements[i].scrollHeight + "px";
        }
      });
    });
  }

  function counter(values, plus, minus, results) {
    plus.forEach((el, i) => {
      let res = results[i].innerHTML;
      values[i].innerHTML = values[i].innerHTML - 0;
      results[i].innerHTML = values[i].innerHTML * res;
      el.addEventListener("click", () => {
        values[i].innerHTML = values[i].innerHTML - 0 + 1;
        results[i].innerHTML = values[i].innerHTML * res;
      });
    });
    minus.forEach((el, i) => {
      let res = results[i].innerHTML;

      if (values[i].innerHTML > 1) {
        values[i].innerHTML -= 1;
        results[i].innerHTML -= res;
      }
      el.addEventListener("click", () => {
        if (values[i].innerHTML > 1) {
          values[i].innerHTML -= 1;
          results[i].innerHTML -= res;
        }
      });
    });
  }

  function counterSummary(values, plus, minus, results) {
    let totalItems = 0;
    values.forEach((el) => {
      totalItems += el.innerHTML - 0;
    });

    let subTotal = 0;
    results.forEach((el) => {
      subTotal += el.innerHTML - 0;
    });

    if (values.length != 0) {
      document.querySelector(".total span").innerHTML = totalItems;
      document.querySelector(".subtotal span").innerHTML = subTotal;
      document.querySelector(".order-total span").innerHTML = subTotal;
    }

    minus.forEach((el, i) => {
      minus[i].querySelector("svg path").style.stroke = "#BBC0C8";
      minus[i].querySelector("svg rect").style.stroke = "#BBC0C8";

      let res = results[i].innerHTML;

      if (values[i].innerHTML > 1) {
        values[i].innerHTML -= 1;
        results[i].innerHTML -= res;
      }
      el.addEventListener("click", () => {
        if (values[i].innerHTML > 1) {
          values[i].innerHTML -= 1;
          results[i].innerHTML -= res;

          totalItems -= 1;

          let subTotal = 0;
          results.forEach((el) => {
            subTotal += el.innerHTML - 0;
          });
          document.querySelector(".total span").innerHTML = totalItems;
          document.querySelector(".subtotal span").innerHTML = subTotal;
          document.querySelector(".order-total span").innerHTML = subTotal;
        }

        if (values[i].innerHTML == 1) {
          minus[i].querySelector("svg path").style.stroke = "#BBC0C8";
          minus[i].querySelector("svg rect").style.stroke = "#BBC0C8";
        }
      });
    });
    plus.forEach((el, i) => {
      let res = results[i].innerHTML;
      values[i].innerHTML = values[i].innerHTML - 0;
      results[i].innerHTML = values[i].innerHTML * res;

      el.addEventListener("click", () => {
        values[i].innerHTML = values[i].innerHTML - 0 + 1;
        results[i].innerHTML = values[i].innerHTML * res;

        minus[i].querySelector("svg path").style.stroke = "#131313";
        minus[i].querySelector("svg rect").style.stroke = "#131313";
        totalItems += 1;

        let subTotal = 0;
        results.forEach((el) => {
          subTotal += el.innerHTML - 0;
        });
        document.querySelector(".total span").innerHTML = totalItems;
        document.querySelector(".subtotal span").innerHTML = subTotal;
        document.querySelector(".order-total span").innerHTML = subTotal;
      });
    });
  }

  function passwordVisible(input) {
    if (input.type === "password") {
      input.type = "text";
    } else {
      input.type = "password";
    }
  }

  function checkSwitch() {
    const checkbox = document.querySelector("#fluency");
    const switchOff = document.querySelector(".switch-off");
    const switchOn = document.querySelector(".switch-on");
    if (checkbox.checked != true) {
      switchOff.style.display = "block";
      switchOn.style.display = "none";
    } else {
      switchOn.style.display = "block";
      switchOff.style.display = "none";
    }
  }

  function modalSwitch(modal, trigger, close, overlay) {
    trigger.forEach((el, i) => {
      el.addEventListener("click", () => {
        modal[i].classList.add("active");
        overlay.classList.add("active");
        disableScroll();
      });
      overlay.addEventListener("click", () => {
        modal[i].classList.remove("active");
        overlay.classList.remove("active");
        disableScroll();
      });
    });

    close.forEach((el, i) => {
      el.addEventListener("click", () => {
        modal[i].classList.remove("active");
        overlay.classList.remove("active");
        enableScroll();
      });
    });
  }

  function modalSwitchTwo(modal, trigger, close) {
    trigger.forEach((el, i) => {
      el.addEventListener("click", () => {
        modal[i].classList.add("active");
      });
    });
    close.forEach((el, i) => {
      el.addEventListener("click", () => {
        modal[i].classList.remove("active");
      });
    });
  }

  function getScrollbarWidth() {
    const outer = document.createElement("div");
    outer.style.visibility = "hidden";
    outer.style.overflow = "scroll";
    document.body.appendChild(outer);

    const inner = document.createElement("div");
    outer.appendChild(inner);

    const scrollbarWidth = outer.offsetWidth - inner.offsetWidth;

    outer.parentNode.removeChild(outer);

    return scrollbarWidth;
  }

  function disableScroll() {
    const scrollbarWidth = getScrollbarWidth();

    document.body.style.paddingRight = scrollbarWidth + "px";
    document.body.style.overflow = "hidden";
  }

  function enableScroll() {
    document.body.style.paddingRight = "0px";
    document.body.style.overflow = "auto";
  }

  //dropdown

  //register
  const dropBtn = document.querySelectorAll(".wrapper__block-drop");
  const dropContent = document.querySelectorAll(".wrapper__block-content");
  //main page
  const dropDashboardBtn = document.querySelectorAll(
    ".content__block.active .content__block-wrapper"
  );
  const dropDashboardContent = document.querySelectorAll(
    ".content__block.active .content__block-plans"
  );

  const dropInvoicesBtn = document.querySelectorAll(
    ".invoices .content__block-wrapper"
  );
  const dropInvoicesContent = document.querySelectorAll(
    ".invoices .content__block-plans"
  );

  //support
  const dropSupportBtn = document.querySelectorAll(".question__title");
  const dropSupportContent = document.querySelectorAll(".question__descr");

  //archive
  const dropArchiveBtn = document.querySelectorAll(
    ".archive__block-content-more"
  );
  const dropArchiveContent = document.querySelectorAll(
    ".archive .wrapper__block-plan-images"
  );

  //counter

  const counterValues = document.querySelectorAll(".value");
  const counterMinus = document.querySelectorAll(".minus");
  const counterPlus = document.querySelectorAll(".plus");
  const counterResults = document.querySelectorAll(".result");

  //sumamry counter

  const summaryCounterValues = document.querySelectorAll(
    ".summery__block-counter span"
  );
  const summaryCounterMinus = document.querySelectorAll(".summary-minus");
  const summaryCounterPlus = document.querySelectorAll(".summary-plus");
  const summaryCounterResults = document.querySelectorAll(
    ".summery__block-result span"
  );

  //modal
  const modals = document.querySelectorAll(".wiro-modal");
  const overlay = document.querySelector(".wiro-modal-overlay");
  const triggers = document.querySelectorAll(".modal-trigger");
  const closeBtns = document.querySelectorAll(".wiro-modal-close");

  //passwordVisible
  const passwordInput = document.querySelectorAll(".password");
  const passwordTrigger = document.querySelectorAll(
    ".wrapper__block-input svg"
  );

  //burger-menu
  const burger = document.querySelectorAll(".burger");
  const sideNav = document.querySelectorAll(".sidenav");
  const sideNavClose = document.querySelectorAll(".sidenav__close");

  try {
    passwordTrigger.forEach((el, i) => {
      el.addEventListener("click", () => {
        passwordVisible(passwordInput[i]);
      });
    });
  } catch {}

  activateDrop(dropContent, dropBtn);
  activateDrop(dropDashboardContent, dropDashboardBtn);
  activateDrop(dropInvoicesContent, dropInvoicesBtn);
  activateDrop(dropSupportContent, dropSupportBtn);
  activateDrop(dropArchiveContent, dropArchiveBtn);
  counter(counterValues, counterPlus, counterMinus, counterResults);
  counterSummary(
    summaryCounterValues,
    summaryCounterPlus,
    summaryCounterMinus,
    summaryCounterResults
  );

  modalSwitch(modals, triggers, closeBtns, overlay);
  modalSwitchTwo(sideNav, burger, sideNavClose);

  const packageBlock = document.querySelector(".package");

  if (packageBlock) {
    dropBtn.forEach((el) => {
      el.addEventListener("click", () => {
        if (packageBlock.classList.contains("active")) {
          packageBlock.style.maxHeight = packageBlock.scrollHeight + 50 + "px";
        }
      });
    });
  }

  // setTimeout(function () {
  //   var dangerAlert = document.getElementById("danger-alert");
  //   if (dangerAlert) {
  //     dangerAlert.style.transition = "opacity 3s ease-in-out";
  //     dangerAlert.style.opacity = "0";
  //     setTimeout(function () {
  //       dangerAlert.style.display = "none";
  //     }, 2000);
  //   }
  // }, 3000);

  // setTimeout(function () {
  //   var successAlert = document.getElementById("success-alert");
  //   if (successAlert) {
  //     successAlert.style.transition = "opacity 3s ease-in-out";
  //     successAlert.style.opacity = "0";
  //     setTimeout(function () {
  //       successAlert.style.display = "none";
  //     }, 2000);
  //   }
  // }, 3000);
});
