<template>
  <form class="form-inline my-2 my-lg-0 search-form" :action="href" @submit.prevent>
    <input
      class="form-control"
      style="width: 100%;"
      type="search"
      placeholder="Search here..."
      aria-label="Search"
      v-model="value"
    />
    <span class="fa fa-search" style="padding: 0 5px;"></span>
  </form>
</template>

<script>
export default {
  props: ["href"],
  data() {
    return {
      value: "",
      time: null
    };
  },
  watch: {
    value() {
      if (this.value.trim() == "") return;
      if (this._time) clearTimeout(this._time);
      this._time = setTimeout(async () => {
        let data = await call_api(`${this.href}?key=${encodeURI(this.value)}`);
        this.$emit("fetch-value", data);
      }, 700);
    }
  }
};
</script>

<style>
</style>