<template>
  <div>
    <Heading title="Weekly Menu"></Heading>

    <NutritionCounter
      label="Week Counter"
      :menuItems="menuItems"
      :start="startDate"
      :end="endDate"
      v-if="showNutritionCounter"
    ></NutritionCounter>

    <div>
      <div class="flex my-4">
        <button @click="previousWeek()">
          <ion-icon name="play-back-outline"></ion-icon>
        </button>
        <button @click="previousDayMixin()">
          <ion-icon name="chevron-back-outline"></ion-icon>
        </button>
        <button @click="goToToday()">
          <ion-icon name="calendar"></ion-icon>Today
        </button>
        <button @click="nextDayMixin()">
          <ion-icon name="chevron-forward-outline"></ion-icon>
        </button>
        <button @click="nextWeek()">
          <ion-icon name="play-forward-outline"></ion-icon>
        </button>
      </div>
      <div
        class="
          flex flex-row
          wrap
          max-w-screen-xl
          border
          justify-between
          overflow-x-auto
        "
      >
        <div
          v-for="(date, index) in dates"
          :key="index"
          class="text-center odd-row-bg min-w-150"
        >
          <span class="inline-flex justify-center w-full mb-2 p-2"
            ><strong v-if="today == date">{{
              showPrettyDateMixin(date)
            }}</strong>
            <template v-else>{{ showPrettyDateMixin(date) }}</template>
          </span>
          <router-link
            :to="{ name: 'meals.menuitems', params: { date: date } }"
            class="btn"
          >
            <span>Edit menu</span>
          </router-link>
          <NutritionCounter
            label="Day Counter"
            :menuItems="menuItems"
            :start="date"
            :end="date"
            v-if="showNutritionCounter"
          ></NutritionCounter>
          <template v-for="menuItem in menuItems">
            <template v-if="menuItem.date == date">
              <MealCard
                :meal="menuItem.meal"
                :showLastTimeOnMenu="false"
                :showCount="false"
                :showEditButton="true"
              ></MealCard>
            </template>
          </template>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Heading from "@/components/headings/Heading";
import MealCard from "@/components/meals/MealCard";
import NutritionCounter from "@/components/nutritions/NutritionCounter";
import DateMixin from "@/mixins/DateMixin";
import moment from "moment";

export default {
  mixins: [DateMixin],

  components: {
    Heading,
    MealCard,
    NutritionCounter,
  },

  data() {
    return {
      mealId: null,
      order: null,
      date: "",
      today: "",
      startDate: "",
      endDate: "",
      menuItems: [],
      meals: [],
      errors: [],
    };
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
    dates() {
      let allDates = [];
      var start = moment(this.startDate);
      var end = moment(this.endDate);
      for (var current = start; current < end; current.add(1, "d")) {
        allDates.push(current.format("YYYY-MM-DD"));
      }
      return allDates;
    },
  },

  methods: {
    setCurrentDate() {
      this.date = this.getCurrentDateMixin();
    },

    setWeekLimits() {
      this.startDate = this.subtractDaysMixin(this.date, 0);
      this.endDate = this.addDaysMixin(this.date, 7);
    },

    // Navigation buttons for 'calendar'
    goToToday() {
      this.date = this.getCurrentDateMixin();
      this.setWeekLimits();
      this.fetchMenuItemsPerWeek();
    },

    previousWeek() {
      this.date = this.subtractDaysMixin(this.date, 7);
      this.setWeekLimits();
      this.fetchMenuItemsPerWeek();
    },

    nextWeek() {
      this.date = this.addDaysMixin(this.date, 7);
      this.setWeekLimits();
      this.fetchMenuItemsPerWeek();
    },

    previousDayMixin() {
      this.date = this.subtractDaysMixin(this.date, 1);
      this.setWeekLimits();
      this.fetchMenuItemsPerWeek();
    },

    nextDayMixin() {
      this.date = this.addDaysMixin(this.date, 1);
      this.setWeekLimits();
      this.fetchMenuItemsPerWeek();
    },

    // Get all menuitems of a week per date
    fetchMenuItemsPerWeek() {
      this.$axios
        .get("/api/menuitems/week/" + this.date)
        .then((response) => {
          this.menuItems = response.data;
        })
        .catch((error) => {
          this.errors.push(error);
        });
    },
  },

  created() {
    this.today = this.getCurrentDateMixin();
    this.setCurrentDate();
    this.setWeekLimits();
    this.fetchMenuItemsPerWeek();
  },
};
</script>


