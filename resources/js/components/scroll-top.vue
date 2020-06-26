<template>
  <div style="cursor: pointer;" @click="onClick">
    <i class="fa fa-arrow-up" aria-hidden="true" style="font-size: 35px; padding: 10px"></i>
  </div>
</template>

<script>
export default {
  name: "ScrollTop",
  props: ["showAt"],
  mounted() {
    window.addEventListener("scroll", this.checkScroll);
    this.checkScroll();
  },
  methods: {
    onClick() {
      document.body.scrollTop = 0; // For Safari
      document.documentElement.scrollTop = 0; //
    },
    checkScroll() {
      if (
        document.body.scrollTop > this.showAt ||
        document.documentElement.scrollTop > this.showAt
      )
        this.$el.style.display = "block";
      else this.$el.style.display = "none";
    }
  }
};
</script>
