<template>
  <div class="item">
    <a :href="item['Seo']" @click="onClick">
      <img :src="item['Avatar']" :alt="item['Name']" />
    </a>
    <h3>
      <a :href="item['Seo']" @click="onClick">{{item['Name']}}</a>
    </h3>
    <h6 v-if="!item['Discount'] || item['Discount'] == 0">
      <span class="price" v-currency>{{item['Price']}}</span> /
      <a :href="item['Seo']" @click="onClick">Buy Now</a>
    </h6>
    <h6 v-else>
      <span class="price" v-currency>{{item['Price'] - (item['Price'] * item['Discount'] / 100)}}</span>
      <del v-currency>{{item['Price']}}</del>
      <a :href="item['Seo']" @click="onClick">Buy Now</a>
    </h6>
  </div>
</template>

<script>
export default {
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