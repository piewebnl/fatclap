<template>
  <div>
    <Heading title="Cookbooks"></Heading>

    <router-link :to="{ name: 'cookbooks.create' }" class="btn my-4">
      <ion-icon name="add-sharp"></ion-icon>
      <span>Add new Cookbook</span>
    </router-link>

    <CookbooksList :cookbooks="cookbooks.data"></CookbooksList>

    <paginate
      v-if="cookbooks.lastPage > 0"
      :value="currentPage"
      :page-count="cookbooks.lastPage"
      :click-handler="handlePagination"
      :prev-text="'Prev'"
      :next-text="'Next'"
      :container-class="'pagination flex'"
    >
    </paginate>
  </div>
</template>

<script>
import Heading from "@/components/headings/Heading";
import CookbooksList from "@/components/cookbooks/CookbooksList";

export default {
  components: {
    Heading,
    CookbooksList,
  },
  data() {
    return {
      cookbooks: [],
      currentPage: 1,
    };
  },

  methods: {
    handlePagination(page) {
      this.currentPage = page;
      this.$router.push({
        name: "cookbooks.index",
        query: { page: this.currentPage },
      });
      this.fetchCookbooks();
    },

    handleRouter() {
      if (this.$route.query.page > 0) {
        this.currentPage = Number(this.$route.query.page);
      }
      this.fetchCookbooks();
    },

    fetchCookbooks() {
      this.$axios
        .get("/api/cookbooks?page=" + this.currentPage)
        .then((response) => {
          this.cookbooks = response.data;
          // Redirect to last page if necessery
          if (this.cookbooks.currentPage > this.cookbooks.lastPage) {
            this.handlePagination(this.cookbooks.lastPage);
          }
        })
        .catch((error) => {
          this.messages = error.response.data;
        });
    },
  },
  created() {
    this.handleRouter();
  },
};
</script>

