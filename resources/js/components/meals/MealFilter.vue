<template>
  <div>
    <form @submit.prevent @keypress.enter.prevent class="flex flex-wrap">
      <div class="mr-6 mb-4">
        <label class="mr-1" for="search">Search</label>
        <input
          type="text"
          v-model="keyword"
          @keypress.enter.prevent
          v-debounce:300ms="fetchMealsByFilter()"
          placeholder="Search meals"
        />
      </div>

      <div class="mr-6 mb-4">
        <label class="mr-1" for="sort">Sort</label>
        <select v-model="order">
          <option
            v-for="(option, index) in orderOptions"
            v-bind:value="option.value"
            :key="index"
          >
            {{ option.label }}
          </option>
        </select>
        <select v-model="ascOrDesc">
          <option
            v-for="(option, index) in ascOrDescOptions"
            v-bind:value="option.value"
            :key="index"
          >
            {{ option.label }}
          </option>
        </select>
      </div>
      <div class="mr-6 mb-4">
        <label class="mr-1" for="mealtype">Mealtype</label>
        <select v-model="mealtype">
          <option value>Select mealtype</option>
          <option
            v-for="(mealtype, index) in mealtypes"
            v-bind:value="mealtype.id"
            :key="index"
          >
            {{ mealtype.name }}
          </option>
        </select>
      </div>
      <div class="mr-6 mb-4">
        <label class="mr-1" for="mealtype">Cookbook</label>
        <select v-model="cookbook">
          <option value>Select cookbook</option>
          <option
            v-for="(cookbook, index) in cookbooks"
            v-bind:value="cookbook.id"
            :key="index"
          >
            {{ cookbook.name }}
          </option>
        </select>
      </div>
      <div class="mr-6 mb-4">
        <label class="mr-1" for="vegatarian">Vegetarian</label>
        <select v-model="isVegetarian">
          <option value>Don't matter</option>
          <option value="true">Yes</option>
          <option value="false">No</option>
        </select>
      </div>
      <div class="mr-6 mb-4">
        <label class="mr-1" for="mealtype">Reset</label>
        <button @click="resetFilter" class="rounded-circle p-0 m-0">
          <ion-icon name="close-sharp"></ion-icon>
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import MealtypesMixin from "@/mixins/MealtypesMixin";
import CookbooksMixin from "@/mixins/CookbooksMixin";

export default {
  mixins: [MealtypesMixin, CookbooksMixin],

  data() {
    return {
      mealtypes: [],
      cookbooks: [],
      orderOptions: [
        { value: "created_at", label: "Date added" },
        { value: "count", label: "Amount times on menu" },
        { value: "last_time_on_menu", label: "Last time on menu" },
      ],
      ascOrDescOptions: [
        { value: "asc", label: "Asc" },
        { value: "desc", label: "Des" },
      ],
    };
  },
  computed: {
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
    fetchMealsByFilter() {
      this.$emit("doFetch", true);
    },
    resetFilter() {
      this.keyword = "";
      this.order = "created_at";
      this.ascOrDesc = "asc";
      this.mealtype = "";
      this.cookbook = "";
      this.isVegetarian = "";
      this.$emit("doFetch", true);
    },
  },
  created() {
    this.fetchAllMealtypesMixin();
    this.fetchAllCookbooksMixin();
  },
};
</script>
