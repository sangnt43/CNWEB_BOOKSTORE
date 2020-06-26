<template>
  <div class="item">
    <img :src="item['Avatar']" :alt="item['Name']" />
    <h3>{{item['Name']}}</h3>
    <h6 v-if="!item['Discount'] || item['Discount'] == 0">
      <span class="price" v-currency>{{item['Price']}}</span>
    </h6>
    <h6 v-else>
      <span class="price" v-currency>{{item['Price'] - (item['Price'] * item['Discount'] / 100)}}</span>
      <del v-currency>{{item['Price']}}</del>
    </h6>
    <div class="hover">
      <a :href="item['Seo']" @click="onClick">
        <span>
          <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
        </span>
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: "Recommend",
  props: ["item"],
  methods: {
    onClick() {
      this.$emit("click", event);
    }
  }
};
</script>

<style>
</style>