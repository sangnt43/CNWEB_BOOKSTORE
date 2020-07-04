<template>
  <div style="cursor: pointer;" @click="onClick">
    <span>
      <i class="fa fa-shopping-cart" aria-hidden="true"></i>
    </span>
    <span class="quntity">{{cartCount}}</span>
  </div>
</template>

<script>
export default {
  name: "ShopCart",
  props: {
    href: {
      default: null
    }, 
    onItemAdd: {
      default: null
    }
  },
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
        if (_) _["quantity"] += Number(quantity);
        else
          this.cart.push({
            id: item["Id"],
            name: item["Name"],
            avatar: item["Avatar"],
            seo: item["Seo"],
            discount: item["Discount"],
            price: item["Price"],
            quantity: quantity
          });
        this.update();

        this.$emit("update:cart", this.cart);
      }
    },
    update() {
      localStorage.setItem("cardItem", JSON.stringify(this.cart));

      if(this.onItemAdd != null)
        this.onItemAdd();
    },
    updateCart() {
      this.cart = JSON.parse(localStorage.getItem("cardItem")) || [];
      this.$emit("update:cart", this.cart);
    },
    onClick() {
      this.$emit("click", this.cart);
      if (this.href) location.replace(this.href);
    }
  }
};
</script>