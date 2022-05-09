<template>
  <div>
    <Heading title="Meals"></Heading>

    <router-link :to="{ name: 'meals.create' }" class="btn mb-4">
      <ion-icon name="add-sharp"></ion-icon>
      <span>Add new meal</span>
    </router-link>

    <button
      @click="showFilters = !showFilters"
      v-if="!showFilters"
      class="my-4"
    >
      <ion-icon name="search"></ion-icon>
      Search &amp; filter meals
    </button>

    <MealFilter v-if="showFilters" @doFetch="fetchMealsByFilter()"></MealFilter>
    <MealsList :meals="meals.data" :showEditButton="true"></MealsList>

    <paginate
      v-if="meals.lastPage > 0"
      :page-count="meals.lastPage"
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
import MealsList from "@/components/meals/MealsList";
import MealFilter from "@/components/meals/MealFilter";
import FormErrorMessages from "@/components/messages/FormErrorMessages";
import MealsMixin from "@/mixins/MealsMixin";

export default {
  mixins: [MealsMixin],

  components: {
    Heading,
    MealsList,
    MealFilter,
    FormErrorMessages,
  },

  data() {
    return {
      errors: [],
      image: null,
      previewImage: null,
      showFilters: false,
    };
  },

  watch: {
    order: function (oldvalue, newvalue) {
      if (oldvalue != newvalue) {
        this.fetchMealsByFilter();
      }
    },
    ascOrDesc: function (oldvalue, newvalue) {
      if (oldvalue != newvalue) {
        this.fetchMealsByFilter();
      }
    },
    mealtype: function (oldvalue, newvalue) {
      if (oldvalue != newvalue) {
        this.fetchMealsByFilter();
      }
    },
    isVegetarian: function (oldvalue, newvalue) {
      if (oldvalue != newvalue) {
        this.fetchMealsByFilter();
      }
    },
  },
  computed: {
    meals: {
      get() {
        return this.$store.state.meals;
      },
      set(value) {
        this.$store.commit("updateMeals", value);
      },
    },
    mealtype: {
      get() {
        return this.$store.state.mealtype;
      },
      set(value) {
        this.$store.commit("updateMealtype", value);
      },
    },
    cookbook: {
      get() {
        return this.$store.state.cookbook;
      },
      set(value) {
        this.$store.commit("updateCookbook", value);
      },
    },
    isVegetarian: {
      get() {
        return this.$store.state.isVegetarian;
      },
      set(value) {
        this.$store.commit("updateIsVegetarian", value);
      },
    },
    keyword: {
      get() {
        return this.$store.state.keyword;
      },
      set(value) {
        this.$store.commit("updateKeyword", value);
      },
    },
    order: {
      get() {
        return this.$store.state.order;
      },
      set(value) {
        this.$store.commit("updateSort", value);
      },
    },
    ascOrDesc: {
      get() {
        return this.$store.state.ascOrDesc;
      },
      set(value) {
        this.$store.commit("updateSortOrder", value);
      },
    },
  },
  methods: {
    handleRouter() {
      if (this.$route.query.page > 0) {
        this.currentPage = Number(this.$route.query.page);
      }
      this.fetchMealsByFilter();
    },

    doFilter() {
      this.fetchMealsByFilter();
    },
    handlePagination(page) {
      this.fetchMealsByFilter(page);
    },

    fetchMealsByFilter(page = 1) {
      let filter = {
        keyword: this.keyword,
        order: this.order,
        ascOrDesc: this.ascOrDesc,
        mealtype: this.mealtype,
        cookbook: this.cookbook,
        isVegetarian: this.isVegetarian,
      };
      this.fetchMealsByFilterMixin(filter, page);
    },
  },
  created() {
    this.handleRouter();
  },
};
</script>


