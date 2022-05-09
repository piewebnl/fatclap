<template>
  <div>
    <Heading title="Mealtypes"></Heading>

    <router-link :to="{ name: 'mealtypes.create' }" class="btn my-4">
      <ion-icon name="add-sharp"></ion-icon>
      <span>Add new mealtype</span>
    </router-link>

    <MealtypesList :mealtypes="mealtypes.data"></MealtypesList>

    <paginate
      v-if="mealtypes.lastPage > 0"
      :page-count="mealtypes.lastPage"
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
import MealtypesList from "@/components/mealtypes/MealtypesList";

export default {
  components: {
    Heading,
    MealtypesList,
  },
  data() {
    return {
      mealtypes: [],
      currentPage: 1,
    };
  },

  methods: {
    handlePagination(page) {
      this.currentPage = page;
      this.$router.push({
        name: "mealtypes.index",
        query: { page: this.currentPage },
      });
      this.fetchMealtypes();
    },

    handleRouter() {
      if (this.$route.query.page > 0) {
        this.currentPage = Number(this.$route.query.page);
      }
      this.fetchMealtypes();
    },

    fetchMealtypes(page = 1) {
      this.$axios
        .get("/api/mealtypes?page=" + this.currentPage)
        .then((response) => {
          this.mealtypes = response.data;
          // Redirect to last page if necessery
          if (this.mealtypes.currentPage > this.mealtypes.lastPage) {
            this.handlePagination(this.mealtypes.lastPage);
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

