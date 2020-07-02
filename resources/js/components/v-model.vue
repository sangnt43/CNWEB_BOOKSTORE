<template>
  <div ref="my-modal" class="modal fade" role="dialog" style="overflow-y: auto">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "v-model",
  props: {
    isActive: {
      default: false
    }
  },
  data() {
    return {};
  },
  mounted() {
      // console.log(this.$slots)
  },
  watch: {
    isActive(val) {
      //check if event is exist
      var _on_model_ = this.$refs["my-modal"].dataset["onModel"];
      if (!_on_model_) {
        $(this.$refs["my-modal"]).on("hidden.bs.modal", () => {
          this.$emit("update:is-active", false);
        });
        this.$refs["my-modal"].dataset["onModel"] = "true";
      }
      $(this.$refs["my-modal"]).modal(val == true ? "show" : "hide");
    }
  }
};
</script>

<style>
</style>