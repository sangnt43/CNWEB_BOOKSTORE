<template>
  <div style="cursor: pointer;">
    <span>
      <i class="fa fa-shopping-cart" aria-hidden="true"></i>
    </span>
    <span class="quntity">{{cartCount}}</span>
  </div>
</template>

<script>
export default {
  name: "ShopCart",
  data() {
    return {
      cart: []
    };
  },
  created() {
    window.addEventListener("storage", () => {
      this.updateCart();
    });
    this.updateCart();
  },
  computed: {
    cartCount() {
      return this.cart.reduce((a, b) => a + b["quantity"], 0);
    }
  },
  methods: {
    push(item, quantity = 1) {
      if (item["Id"]) {
        let _ = this.cart.find(x => x.id == item["Id"]);
        if (_) _["quantity"] += quantity;
        else
          this.cart.push({
            id: item["Id"],
            seo: item["Seo"],
            quantity: quantity
          });
        localStorage.setItem("cardItem", JSON.stringify(this.cart));
      }
    },
    updateCart() {
      this.cart = JSON.parse(localStorage.getItem("cardItem")) || [];
    }
  }
};
</script>