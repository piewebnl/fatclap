<template>
  <div>
    <div class="p-4">
      <MealtypeLetter
        v-if="meal.mealtype"
        :letter="meal.mealtype.name[0]"
        :color="meal.mealtype.color"
      ></MealtypeLetter>
      <span class="text-lg inline-block mb-2">{{ meal.name }}</span>
      <NutritionCard
        :nutrition="nutrition"
        v-if="showNutritionCounter === true"
      ></NutritionCard>
      <div class="flex justify-center mb-2">
        <MealImage
          :image="meal.images[0]"
          :name="meal.name"
          v-if="meal.images[0] !== undefined"
        ></MealImage>
      </div>
      <div v-if="showCount" class="mt-2 text-xs">
        <span>Amount times:</span>
        {{ meal.count }}
      </div>
      <div
        class="text-xs"
        v-if="showLastTimeOnMenu && meal.lastTimeOnMenu != undefined"
      >
        <span>Last time:</span>
        {{ showFullDateMixin(meal.lastTimeOnMenu) }}
      </div>
      <div v-if="showEditButton" class="mt-2">
        <ButtonRouterLink
          v-if="meal.id"
          :to="{ name: 'meals.edit', params: { id: meal.id } }"
          ionIcon="pencil-sharp"
          type=""
          class="mr-4"
        ></ButtonRouterLink>
      </div>

      <div v-if="showAddButton" class="mt-2">
        <Button
          v-if="meal.id"
          @emitClicked="addToMenu(meal)"
          title="Add to menu"
          ionIcon="add-sharp"
          type=""
          class="mr-4"
          :disabled="disableAddButton"
        ></Button>
      </div>
      <div v-if="showDeleteButton" class="mt-2">
        <Button
          v-if="meal.id"
          @emitClicked="deleteMeal(meal.id)"
          title=""
          ionIcon="close-sharp"
          type="delete"
          class="mr-4"
        ></Button>
      </div>
    </div>
  </div>
</template>

<script>
import Button from "@/components/buttons/Button";
import ButtonRouterLink from "@/components/buttons/ButtonRouterLink";
import MealsMixin from "@/mixins/MealsMixin";
import MealImage from "@/components/meals/MealImage";
import MealtypeLetter from "@/components/mealtypes/MealtypeLetter";
import NutritionCard from "@/components/nutritions/NutritionCard";
import DateMixin from "@/mixins/DateMixin";

export default {
  mixins: [DateMixin, MealsMixin],

  components: {
    Button,
    ButtonRouterLink,
    MealImage,
    MealtypeLetter,
    NutritionCard,
  },

  props: {
    meal: {
      type: Object,
      default: {},
      required: true,
    },
    showLastTimeOnMenu: {
      type: Boolean,
      default: true,
    },
    showCount: {
      type: Boolean,
      default: true,
    },
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
    disableAddButton: {
      type: Boolean,
      default: false,
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

    showNutritionCounter: {
      get() {
        return this.$store.state.showNutritionCounter;
      },
      set(value) {
        this.$store.commit("updateShowNutritionCounter", value);
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

    messages: {
      get() {
        return this.$store.state.messages;
      },
      set(value) {
        this.$store.commit("updateMessages", value);
      },
    },

    nutrition() {
      let all = {
        calories: this.meal.calories,
        carbs: this.meal.carbs,
        fats: this.meal.fats,
        proteins: this.meal.proteins,
      };
      return all;
    },

    mealTypeClass() {
      if (this.meal.mealtype != null) {
        return "mealtype-" + this.meal.mealtype.id;
      }
      return "";
    },
  },

  methods: {
    addToMenu(meal) {
      this.tempMeal = meal;
    },
    deleteMeal(id) {
      this.deleteMealMixin(id);
    },
  },
};
</script>

