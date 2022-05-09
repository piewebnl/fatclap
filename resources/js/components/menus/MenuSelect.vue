<template>
  <div>
    <div>
      <Heading title="Change Menu"></Heading>

      <div class="my-4">
        <NutritionCounter
          :menuItems="menuItems"
          :start="startDate"
          :end="endDate"
          :showDates="true"
          label="Weekly total:"
          v-if="showNutritionCounter"
        ></NutritionCounter>
      </div>
    </div>

    <div>
      <h2>All meals</h2>
      <button
        @click="showFilters = !showFilters"
        v-if="!showFilters"
        class="my-4"
      >
        <ion-icon name="search"></ion-icon>
        Search &amp; filter meals
      </button>
      <MealFilter
        v-if="showFilters"
        @doFetch="fetchMealsByFilter()"
      ></MealFilter>
    </div>

    <div class="flex flex-row max-w-4xl">
      <div class="w-1/2">
        <MealsList
          :meals="meals.data"
          :showAddButton="true"
          :showEditButton="false"
          :showInGrid="false"
          :disableAddButton="disableAddButton"
        ></MealsList>

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

      <div class="w-1/2 p-4">
        <h3 class="text-center" v-if="getCurrentDateMixin() == date">
          Today's menu<br />
          <span class="text-sm">{{ showPrettyDateMixin(date) }}</span>
        </h3>
        <h3 class="text-center" v-else>{{ showPrettyDateMixin(date) }}</h3>

        <div class="flex flex-wrap justify-center my-4">
          <button @click="goPreviousDay()">
            <ion-icon name="chevron-back-outline"></ion-icon>
            {{ showPrettyDateMixin(previousDayMixin(date)) }}
          </button>
          <button @click="goNextDay()">
            {{ showPrettyDateMixin(nextDayMixin(date))
            }}<ion-icon name="chevron-forward-outline"></ion-icon>
          </button>
        </div>

        <NutritionCounter
          :menuItems="menuItemsToday"
          :start="date"
          :end="date"
          label="Daily"
          v-if="showNutritionCounter"
        ></NutritionCounter>

        <div>
          <p class="my-4">Add items to menu, drag to reorder</p>
          <input type="hidden" :value="csrfToken" name="_token" />
          <draggable
            :list="menuItemsToday"
            group="menuListGroup"
            delay="delay:400"
            @start="drag = true"
            @end="drag = false"
            @change="menuListOrderChange"
          >
            <div
              v-for="(menuItem, index) in menuItemsToday"
              class="
                flex flex-col flex-wrap
                content-center
                bg-gray-300
                border-4 border-gray-100
                cursor-move
              "
              :key="index"
            >
              <MealCard
                :meal="menuItem.meal"
                :showCount="false"
                :showLastTimeOnMenu="false"
              ></MealCard>
              <button
                class="self-center"
                @click="deleteMenuItem(menuItem.id, menuItem.mealId)"
              >
                <ion-icon name="close-sharp"></ion-icon>
              </button>
            </div>
          </draggable>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Heading from "@/components/headings/Heading";
import MealCard from "@/components/meals/MealCard";
import MealFilter from "@/components/meals/MealFilter";
import MealsList from "@/components/meals/MealsList";
import NutritionCounter from "@/components/nutritions/NutritionCounter";
import DateMixin from "@/mixins/DateMixin";
import Draggable from "vuedraggable";
import MealsMixin from "@/mixins/MealsMixin";

export default {
  mixins: [DateMixin, MealsMixin],

  components: {
    Heading,
    Draggable,
    MealCard,
    MealsList,
    MealFilter,
    NutritionCounter,
  },

  data() {
    return {
      mealId: null,
      csrfToken: null,
      date: "",
      menuItems: [],
      showFilters: false,
      loadMeals: false,
      disableAddButton: false,
    };
  },

  watch: {
    tempMeal: function (newValue) {
      if (JSON.stringify(newValue) !== "{}") {
        this.addToMenu(newValue);
      }
    },
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
    cookbook: function (oldvalue, newvalue) {
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
    menuItemsToday() {
      let menuItemsToday = [];
      this.menuItems.forEach((item) => {
        if (item.date == this.date) {
          menuItemsToday.push(item);
        }
      });
      return menuItemsToday;
    },
    meals: {
      get() {
        return this.$store.state.meals;
      },
      set(value) {
        this.$store.commit("updateMeals", value);
      },
    },
    tempMeal: {
      get() {
        return this.$store.state.tempMeal;
      },
      set(value) {
        this.$store.commit("updateTempMeal", value);
      },
    },

    showNutritionCounter: {
      get() {
        return this.$store.state.showNutritionCounter;
      },
      set(value) {
        this.$store.commit("updateShowNutritionCounter", value);
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
    messages: {
      get() {
        return this.$store.state.messages;
      },
      set(value) {
        this.$store.commit("updateMessages", value);
      },
    },
  },

  methods: {
    doFilter() {
      this.fetchMealsByFilter();
    },

    handlePagination(page) {
      this.fetchMealsByFilter(page);
    },

    setWeekLimits() {
      this.startDate = this.subtractDaysMixin(this.date, 0);
      this.endDate = this.addDaysMixin(this.date, 7);
    },

    goPreviousDay() {
      this.date = this.previousDayMixin(this.date);
      this.setWeekLimits();
      this.fetchMenuItemsPerWeek();
    },

    goNextDay() {
      this.date = this.nextDayMixin(this.date);
      this.setWeekLimits();
      this.fetchMenuItemsPerWeek();
    },

    fetchMenuItemsPerWeek() {
      this.$axios
        .get("/api/menuitems/week/" + this.date)
        .then((response) => {
          if (response.data != undefined) {
            this.menuItems = response.data;
          }
        })
        .catch((error) => {});
    },

    fetchMealsByFilter(page = 1) {
      this.loadMeals = true;
      let filter = {
        keyword: this.keyword,
        order: this.order,
        ascOrDesc: this.ascOrDesc,
        mealtype: this.mealtype,
        cookbook: this.cookbook,
        isVegetarian: this.isVegetarian,
      };
      this.fetchMealsByFilterMixin(filter, page);
      this.loadMeals = false;
    },

    menuListOrderChange(event) {
      let movedMenutItem = event.moved.element;

      if (movedMenutItem.id != null) {
        let upOrDown = "shiftup";
        if (event.moved.newIndex > event.moved.oldIndex) {
          upOrDown = "shiftdown";
        }

        let menuItem = {
          id: movedMenutItem.id,
          date: movedMenutItem.date,
          order: event.moved.newIndex,
          moveAmount: Math.abs(event.moved.newIndex - event.moved.oldIndex),
        };
        this.updateMenuItemOrder(menuItem, upOrDown);
      }
    },

    addToMenu(meal) {
      this.disableAddButton = true;
      this.$axios
        .put("/api/meals/count", { id: meal.id, addOrDelete: "add" })
        .then(() => {})
        .catch((error) => {
          console.log(error);
        });

      meal.count++;
      meal.lastTimeOneMenu = this.getCurrentDateMixin();
      let index = this.meals.data.findIndex((item) => item.id == meal.id);
      this.meals.data.splice(index, 1, meal);

      // Create an empty menu-item slot first
      let newMenuItem = {
        mealId: meal.id,
        date: this.date,
        lastTimeOneMenu: meal.lastTimeOneMenu,
        count: meal.count,
        order: this.menuItems.length,
      };

      // Copy all meal data into it
      newMenuItem.meal = meal;

      this.storeMenuItem(newMenuItem);
    },

    storeMenuItem(menuItem) {
      this.$axios
        .post("/api/menuitems", menuItem)
        .then((response) => {
          // Add the new id from the database
          menuItem.id = response.data.resource.id;
          this.menuItems.push(menuItem);
          this.tempMeal = {};
          this.messages = response.data;
          this.disableAddButton = false;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    updateMenuItemOrder(menuItem, upOrDown) {
      this.$axios
        .put("/api/menuitems/" + upOrDown + "/" + menuItem.id, menuItem)
        .then((response) => {
          this.messages = response.data;
          this.tempMeal = {};
        })
        .catch((error) => {
          console.log(error);
        });
    },

    updateCount(mealId) {
      this.$axios
        .put("/api/meals/count", { id: mealId, addOrDelete: "delete" })
        .then((response) => {
          let meal = response.data.resource;
          if (meal.count > 0) {
            meal.count--;
          }
          meal.lastTimeOneMenu = response.data.lastTimeOneMenu;
          let index = this.meals.data.findIndex((item) => item.id == meal.id);
          this.meals.data.splice(index, 1, meal);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    deleteMenuItem(id, mealId) {
      if (id) {
        this.$axios
          .delete("/api/menuitems/" + id)
          .then((response) => {
            let index = this.menuItems.findIndex((obj) => obj.id == id);
            this.menuItems.splice(index, 1);
            this.messages = response.data;
            this.updateCount(mealId);
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },

  mounted() {
    this.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
  },

  created() {
    if (this.$route.params.date) {
      this.date = this.$route.params.date;
    } else {
      this.date = this.getCurrentDateMixin();
    }
    this.setWeekLimits();
    this.fetchMenuItemsPerWeek();
    this.fetchMealsByFilter();
  },
};
</script>
