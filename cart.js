document.addEventListener("DOMContentLoaded", () => {
  updateTotal();

  document.querySelectorAll(".qty-btn").forEach(btn => {
    btn.addEventListener("click", () => {
      const input = btn.parentElement.querySelector(".qty-input");
      let qty = parseInt(input.value);
      qty = btn.classList.contains("plus") ? qty + 1 : Math.max(1, qty - 1);
      input.value = qty;
      updateTotal();
    });
  });

  document.querySelectorAll(".gift-wrap").forEach(box => {
    box.addEventListener("change", updateTotal);
  });
});

function updateTotal() {
  let total = 0;

  document.querySelectorAll(".cart-card").forEach(card => {
    const price = parseInt(card.dataset.price);
    const qty = parseInt(card.querySelector(".qty-input").value);
    const giftWrap = card.querySelector(".gift-wrap").checked ? 50 : 0;
    total += (price * qty) + giftWrap;
  });

  document.getElementById("totalPrice").textContent = total;
}

function removeItem(button) {
  const card = button.closest(".cart-card");
  card.remove();
  updateTotal();
}

function checkout() {
  const messages = [];
  document.querySelectorAll(".cart-card").forEach(card => {
    const name = card.querySelector("h3").textContent;
    const qty = card.querySelector(".qty-input").value;
    const gift = card.querySelector(".gift-wrap").checked;
    const message = card.querySelector(".gift-message").value;
    messages.push({ name, qty, gift, message });
  });

  console.log("Checkout data:", messages);
  alert("Thank you for your order! 🎉");
  // Add actual checkout logic here
}
