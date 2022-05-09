<template>
  <div>
    <table v-if="anyValuesToShow" class="w-full max-w-sm">
      <thead>
        <tr>
          <th
            class="p-1 text-xs center border-gray bg-gray-300"
            v-if="user.calories > 0"
          >
            Cal
          </th>
          <th
            class="p-1 text-xs center border-gray bg-gray-300"
            v-if="user.carbs > 0"
          >
            Crb
          </th>
          <th
            class="p-1 text-xs center border-gray bg-gray-300"
            v-if="user.fats > 0"
          >
            Fat
          </th>
          <th
            class="p-1 text-xs center border-gray bg-gray-300"
            v-if="user.proteins > 0"
          >
            Pro
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center text-xs" v-if="user.calories > 0">
            <span
              :class="'bar ' + checkLimit('calories')"
              :style="doPercentageBackground('calories')"
            ></span>
            <span>{{ nutrition.calories }}</span>
          </td>
          <td class="text-center text-xs" v-if="user.carbs > 0">
            <span
              :class="'bar ' + checkLimit('carbs')"
              :style="doPercentageBackground('carbs')"
            ></span>
            <span>{{ nutrition.carbs }}</span>
          </td>
          <td class="text-center text-xs" v-if="user.fats > 0">
            <span
              :class="'bar ' + checkLimit('fats')"
              :style="doPercentageBackground('fats')"
            ></span>
            <span>{{ nutrition.fats }}</span>
          </td>
          <td class="text-center text-xs" v-if="user.proteins > 0">
            <span
              :class="'bar ' + checkLimit('proteins')"
              :style="doPercentageBackground('proteins')"
            ></span>
            <span>{{ nutrition.proteins }}</span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    nutrition: {
      type: Object,
      required: true,
      default: {},
    },

    useWeeklyLimits: {
      type: Boolean,
      default: false,
    },
  },

  computed: {
    user: {
      get() {
        return this.$store.state.user;
      },
    },

    anyValuesToShow() {
      let result = false;
      let values = Object.values(this.nutrition);
      values.forEach(function (value) {
        if (value !== null) {
          result = true;
        }
      });
      this.setNutritionLimits();
      return result;
    },
  },

  methods: {
    setNutritionLimits() {
      if (this.useWeeklyLimits) {
        this.nutritionLimits = {
          calories: this.user.calories * 7,
          carbs: this.user.carbs * 7,
          proteins: this.user.proteins * 7,
          fats: this.user.fats * 7,
        };
      } else {
        this.nutritionLimits = {
          calories: this.user.calories,
          carbs: this.user.carbs,
          proteins: this.user.proteins,
          fats: this.user.fats,
        };
      }
    },

    checkLimit(field) {
      if (this.nutritionLimits !== undefined) {
        let percentage = Math.round(
          (this.nutrition[field] / this.nutritionLimits[field]) * 100
        );
        if (percentage > 100) {
          return "limit-100";
        }
        if (percentage > 75) {
          return "limit-75";
        }
        if (percentage > 50) {
          return "limit-50";
        }
        if (percentage > 25) {
          return "limit-25";
        }
        return "limit-0";
      }
    },

    doPercentageBackground(field) {
      if (this.nutritionLimits !== undefined && this.nutrition[field] > 0) {
        let percentage = Math.round(
          (this.nutrition[field] / this.nutritionLimits[field]) * 100
        );

        if (percentage > 100) {
          percentage = 100;
        }
        return "height: " + percentage + "%;";
      }
      return "";
    },
  },
};
</script>
