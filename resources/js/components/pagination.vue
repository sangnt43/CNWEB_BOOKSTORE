<template>
  <nav>
    <ul class="pagination justify-content-center">
      <li class="page-item" v-if="currentPage != 1">
        <a class="page-link" @click.prevent="currentPage--" href="#" tabindex="-1">
          <i class="fa fa-chevron-left" aria-hidden="true"></i>
        </a>
      </li>

      <li
        v-for="(item) in pageList"
        :key="item.page"
        :class="{active: currentPage == item.page}"
        class="page-item"
      >
        <a
          v-if="item.type == 0"
          class="page-link"
          @click.prevent="currentPage = item.page"
          href="#"
        >{{item.page}}</a>
        <a v-else>...</a>
      </li>

      <li class="page-item" v-if="currentPage != totalPage && totalPage != 0">
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
    },
    page: {
      default: 1
    },
    length: {
      default: 3
    }
  },
  data() {
    return {
      currentPage: 1
    };
  },
  computed: {
    pageList() {
      let _ = [];
      _.push({ page: 1, type: 0 });

      if (this.currentPage > 3) _.push({ type: 1 });

      // push page
      for (let i = 0; i < this.length; i++) {
        if (
          this.currentPage - Math.floor(this.length / 2) + i <= 1 ||
          this.currentPage - Math.floor(this.length / 2) + i >= this.totalPage
        )
          continue;
        _.push({
          page: this.currentPage - Math.floor(this.length / 2) + i,
          type: 0
        });
      }

      if (this.currentPage < this.totalPage - 2) _.push({ type: 1 });

      if (this.totalPage != 1) _.push({ page: this.totalPage, type: 0 });

      return _;
    }
  },
  watch: {
    page(value) {
      this.currentPage = value;
    },
    currentPage(value) {
      this.$emit("update:page", value);
    }
  }
};
</script>

<style>
</style>