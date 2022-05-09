<template>
  <div>
    <div v-if="label" class="my-2">{{ label }}</div>
    <div v-if="showDates" class="my-2">
      {{ showPrettyDateMixin(start) }} - {{ showPrettyDateMixin(end) }}
    </div>
    <NutritionCard
      :nutrition="nutrition"
      :useWeeklyLimits="useWeeklyLimits"
    ></NutritionCard>
  </div>
</template>

<script>
import NutritionCard from "@/components/nutritions/NutritionCard";
import DateMixin from "@/mixins/DateMixin";
import MealsMixin from "@/mixins/MealsMixin";
import moment from "moment";

export default {
  mixins: [DateMixin],

  props: {
    menuItems: {
      type: Array,
      required: true,
      default: {},
    },
    useWeeklyLimits: {
      type: Boolean,
      default: false,
    },
    showDates: {
      type: Boolean,
      default: false,
    },
    start: {
      type: String,
      required: true,
      default: {},
    },
    end: {
      type: String,
      required: true,
      default: {},
    },
    label: {
      type: String,
    },
  },

  components: {
    NutritionCard,
  },

  computed: {
    nutrition() {
      return {
        calories: this.counter("calories"),
        carbs: this.counter("carbs"),
        fats: this.counter("fats"),
        proteins: this.counter("proteins"),
      };
    },
  },

  methods: {
    counter(field) {
      let total = 0;
      let start = this.start;
      let end = this.end;
      this.menuItems.forEach(function (menuItem) {
        if (
          moment(menuItem.date).isSameOrAfter(start) &&
          moment(menuItem.date).isSameOrBefore(end)
        ) {
          total = total + menuItem.meal[field];
        }
      });
      return total;
    },
  },
};
</script>


