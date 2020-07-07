<template>
  <div>
    <select
      :class="selectClass"
      :id="id"
      :disabled="disabled"
      :required="required"
      :multiple="multiple"
    ></select>
  </div>
</template>

<script>
export default {
  data() {
    return {
      select2: null
    };
  },
  model: {
    prop: "value",
    event: "change"
  },
  props: {
    id: {
      type: String
    },
    selectClass: {
      type: String
    },
    options: {
      type: Array,
      default: () => []
    },
    disabled: {
      type: Boolean,
      default: false
    },
    multiple: {
      type: Boolean,
      default: false
    },
    required: {
      type: Boolean,
      default: false
    },
    settings: {
      type: Object,
      default: () => {}
    },
    value: null
  },
  watch: {
    options(val) {
      this.setOption(val);
    },
    value(val) {
      this.setValue(val);
    }
  },
  methods: {
    setOption(val = []) {
      this.select2.empty();
      this.select2.select2({
        ...this.settings,
        data: val
      });
      this.setValue(this.value);
    },
    setValue(val) {
      if (val instanceof Array) this.select2.val([...val]);
      else this.select2.val([val]);
      this.select2.trigger("change");
    }
  },
  mounted() {
    this.select2 = $(this.$el)
      .find("select")
      .select2({
        ...this.settings,
        data: this.options
      })
      .on("select2:select select2:unselect", ev => {
        this.$emit("change", this.select2.val());
        this.$emit("select", ev["params"]["data"]);
      });
    this.setValue(this.value);
  },
  beforeDestroy() {
    this.select2.select2("destroy");
  }
};
</script>

<style>
</style>