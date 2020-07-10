const packageName = require('packageName');
<template>
  <select class="duallistbox" multiple="multiple">
    <slot></slot>
  </select>
</template>

<script>
export default {
  props: ["value"],
  mounted: function() {
    window.addEventListener("DOMContentLoaded", () => {
      this.dual = $(this.$el)
        .bootstrapDualListbox()
        .val(this.value)
        .bootstrapDualListbox("refresh", true)
        .trigger("change")
        .on("change", () => {
          if ($(this.$el).val()) this.$emit("input", $(this.$el).val());
          else this.$emit("input", []);
        });
    });
    $(".moveall i")
      .removeClass()
      .addClass("fas fa-angle-right");
    $(".removeall i")
      .removeClass()
      .addClass("fas fa-angle-left");
    $(".move").remove();
    $(".remove").remove();
  },
  data() {
    return {
      dual: null
    };
  },
  watch: {
    value: function(value) {
      if (value.length == 0)
        $(this.$el)
          .val(value)
          .bootstrapDualListbox("refresh");
    }
  },
  destroyed: function() {
    $(this.$el)
      .off()
      .destroy();
  }
};
</script>

<style>
</style>