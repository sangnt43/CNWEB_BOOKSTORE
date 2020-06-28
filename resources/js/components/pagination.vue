<template>
  <nav>
    <ul class="pagination justify-content-center">
      <li class="page-item" v-if="currentPage!=1">
        <a class="page-link" @click.prevent="currentPage--" href="#" tabindex="-1">
          <i class="fa fa-chevron-left" aria-hidden="true"></i>
        </a>
      </li>

      <li
        v-for="index in totalPage"
        :key="index + 1"
        class="page-item"
        :class="{active: currentPage == index}"
      >
        <a class="page-link" @click.prevent="currentPage = index" href="#">{{index}}</a>
      </li>

      <li class="page-item" v-if="currentPage != totalPage">
        <a class="page-link" @click.prevent="currentPage++" href="#">
          <i class="fa fa-chevron-right" aria-hidden="true"></i>
        </a>
      </li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: "pagination",
  props: {
    totalPage: {
      default: 1
    }
  },
  data() {
    return {
      currentPage: 1
    };
  },
  watch: {
    currentPage(value) {
      this.$emit("click", value);
    }
  }
};
</script>

<style>
</style>