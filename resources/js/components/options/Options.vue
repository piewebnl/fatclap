<template>
  <div>
    <Heading title="Options"></Heading>

    <div>
      <button
        v-model="showNutritionCounter"
        @click="
          changeFilterButton('showNutritionCounter', showNutritionCounter)
        "
        class="mb-2"
      >
        <span v-if="showNutritionCounter === true"
          >Hide Meal Nutrition Counter</span
        >
        <span v-else>Show Meal Nutrition Counter</span>
      </button>
    </div>
  </div>
</template>

<script>
import Heading from "@/components/headings/Heading";

export default {
  components: {
    Heading,
  },

  computed: {
    showNutritionCounter: {
      get() {
        return this.$store.state.showNutritionCounter;
      },
      set(value) {
        this.$store.commit("updateShowNutritionCounter", value);
      },
    },
  },

  methods: {
    changeFilterButton(name, value) {
      this[name] = !value;
      this.setCookie(name);
    },
    setCookie(name) {
      this.$cookies.set(name, this[name]);
    },
  },
};
</script>
