<template>
  <div class="flex flex-row flex-wrap">
    <div
      class="bg-white border-4 border-gray-100"
      v-for="(meal, index) in meals.data"
      :key="index"
      :class="classShowInGrid"
    >
      <MealCard
        :meal="meal"
        :showEditButton="showEditButton"
        :showAddButton="showAddButton"
        :showDeleteButton="showDeleteButton"
        :disableAddButton="disableAddButton"
      ></MealCard>
    </div>
  </div>
</template>

<script>
import MealCard from "@/components/meals/MealCard";

export default {
  props: {
    showEditButton: {
      type: Boolean,
      default: false,
    },
    showAddButton: {
      type: Boolean,
      default: false,
    },
    showDeleteButton: {
      type: Boolean,
      default: false,
    },
    showInGrid: {
      type: Boolean,
      default: true,
    },
    disableAddButton: {
      type: Boolean,
      default: false,
    },
  },

  components: {
    MealCard,
  },

  computed: {
    classShowInGrid: {
      get() {
        if (this.showInGrid) {
          return "w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/5 xl:w-1/6 xxl:w-1/8";
        }
        return "w-full max-w-960";
      },
    },
    meals: {
      get() {
        return this.$store.state.meals;
      },
    },
  },
};
</script>

