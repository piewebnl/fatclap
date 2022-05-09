<template>
  <div>
    <Heading title="Meal"></Heading>
    <form
      @submit.prevent
      @keypress.enter.prevent
      v-if="showForm"
      class="border rounded-xl p-6 bg-white"
    >
      <input type="hidden" :value="csrfToken" name="_token" readonly />
      <input type="hidden" v-model="meal.id" name="id" readonly />

      <div class="flex flex-row flex-wrap w-full justify-end mt-4">
        <Button
          v-if="id"
          @emitClicked="deleteMeal(id)"
          title="Delete"
          ionIcon="close-sharp"
          type="delete"
          class="mr-4"
        ></Button>
        <Button
          @emitClicked="formSubmit()"
          title="Save"
          ionIcon="save"
          type="save"
        ></Button>
      </div>

      <div class="mb-6">
        <label for="name">Meal name</label>
        <div>
          <input type="text" class="w-1/2" v-model="meal.name" name="name" />
          <FormErrorMessages :formErrors="formErrors.name"></FormErrorMessages>
        </div>
      </div>

      <div class="mb-6">
        <template>
          <label for="mealtype">Type</label>
          <div>
            <select v-model="meal.mealtypeId">
              <option value>Select mealtype</option>
              <option
                v-for="(mealtype, index) in mealtypes"
                v-bind:value="mealtype.id"
                :key="index"
              >
                {{ mealtype.name }}
              </option>
            </select>
            <FormErrorMessages
              :formErrors="formErrors.mealtypeId"
            ></FormErrorMessages>
          </div>
        </template>
      </div>
      <div class="mb-6">
        <template>
          <label for="cookbook">Cookbook</label>
          <div>
            <select v-model="meal.cookbookId">
              <option value>Select cookbook</option>
              <option
                v-for="(cookbook, index) in cookbooks"
                v-bind:value="cookbook.id"
                :key="index"
              >
                {{ cookbook.name }}
              </option>
            </select>
            <FormErrorMessages
              :formErrors="formErrors.mealtypeId"
            ></FormErrorMessages>
          </div>
        </template>
      </div>

      <div class="mb-6">
        <div>
          <label for="image">Image</label>
          <div>
            <div class="max-w-xs" v-if="getImageId()">
              <MealImage :image="meal.images[0]"></MealImage>
            </div>
            <FormErrorMessages
              :formErrors="formErrors.image"
            ></FormErrorMessages>
            <button
              @click="deleteImage(meal.images[0].id)"
              v-if="getImageId()"
              class="mt-4 bg-red-600 text-white"
            >
              <ion-icon name="close-sharp"></ion-icon>
              <span>Delete image</span>
            </button>
            <div class="w-full">
              <ProgressBar
                :percentage="uploadPercentage"
                v-if="uploadPercentage > 0"
              >
              </ProgressBar>

              Upload new image:
              <img :src="previewImage" class="flex max-w-xs" />

              <input
                type="file"
                accept="image/jpeg"
                name="image"
                @change="handleImage"
                class="max-w-xs"
              />
            </div>
          </div>
        </div>
      </div>

      <div class="mb-6">
        <label for="url">URL</label>
        <div>
          <input type="text" name="url" class="w-full" v-model="meal.url" />
        </div>
      </div>

      <div class="mb-6">
        <label for="vegatarian">Is Vegetarian?</label>
        <div>
          <input
            type="checkbox"
            name="is_vegatarian"
            v-model="meal.isVegetarian"
          />
        </div>
      </div>

      <div class="mb-6">
        <label for="lowcarb">Is Low Carb?</label>
        <div>
          <input type="checkbox" name="is_low_carb" v-model="meal.isLowCarb" />
        </div>
      </div>

      <div class="mb-6 flex flex-wrap">
        <div class="mr-4 mb-2">
          <label for="calories">Calories</label>
          <input
            type="number"
            name="calories"
            min="0"
            class="w-24"
            v-model="meal.calories"
            id="calories"
          />
        </div>
        <div class="mr-4 mb-2">
          <label for="carbs">Carbs</label>
          <input
            type="text"
            name="carbs"
            min="0"
            class="w-24"
            v-model="meal.carbs"
            id="carbs"
          />
        </div>
        <div class="mr-4 mb-2">
          <label for="fats">Fats</label>
          <input
            type="text"
            name="fats"
            min="0"
            class="w-24"
            v-model="meal.fats"
            id="fats"
          />
        </div>
        <div class="mr-4 mb-2">
          <label for="proteins">Proteins</label>
          <input
            type="text"
            name="proteins"
            min="0"
            class="w-24"
            v-model="meal.proteins"
            id="proteins"
          />
        </div>
      </div>

      <div class="mb-6">
        <label for="description">Description</label>
        <div>
          <textarea
            cols="80"
            rows="6"
            name="description"
            v-model="meal.description"
          ></textarea>
        </div>
      </div>

      <div class="mb-6">
        <label for="ingredients">Ingredients</label>
        <div>
          <textarea
            cols="80"
            rows="6"
            name="ingredients"
            v-model="meal.ingredients"
          ></textarea>
        </div>
      </div>

      <div class="mb-6">
        <label for="preperation">Preperation</label>
        <div>
          <textarea
            cols="80"
            rows="6"
            name="preperation"
            v-model="meal.preperation"
          ></textarea>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
import Button from "@/components/buttons/Button";
import Heading from "@/components/headings/Heading";
import MealImage from "@/components/meals/MealImage";
import ProgressBar from "@/components/progressbar/ProgressBar";
import MealsMixin from "@/mixins/MealsMixin";
import MealtypesMixin from "@/mixins/MealtypesMixin";
import CookbooksMixin from "@/mixins/CookbooksMixin";
import FormErrorMessages from "@/components/messages/FormErrorMessages";

export default {
  mixins: [MealsMixin, MealtypesMixin, CookbooksMixin],

  components: {
    Button,
    Heading,
    MealImage,
    FormErrorMessages,
    ProgressBar,
  },

  data() {
    return {
      mealtypes: [],
      cookbooks: [],
      formErrors: [],
      id: null,
      meal: {},
      image: null,
      previewImage: null,
      csrfToken: null,
      showForm: false,
      uploadPercentage: 0,
      redirectToIndex: true, // false when uploading images
    };
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
    handleRouter() {
      this.fetchAllMealtypesMixin();
      this.fetchAllCookbooksMixin();
      this.id = this.$route.params.id;
      if (this.id) {
        this.fetchMeal();
      } else {
        this.showForm = true;
      }
    },

    getImageId() {
      if (this.meal.images !== undefined && this.meal.images[0] !== undefined) {
        return this.meal.images[0].id;
      }
    },

    formSubmit() {
      this.redirectToIndex = true;
      this.formErrors = {};
      if (this.meal.id) {
        this.updateMeal();
      } else {
        this.storeMeal();
      }
    },

    fetchMeal() {
      this.$axios
        .get("/api/meals/" + this.id)
        .then((response) => {
          this.meal = response.data;
          this.showForm = true;
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.formErrors = error.response.data.errors;
          }
        });
    },

    async storeMeal() {
      await this.$axios
        .post("/api/meals", this.meal)
        .then((response) => {
          this.messages = response.data;
          if (this.redirectToIndex) {
            this.$router.push({ name: "meals.index" });
          }
        })
        .catch((error) => {});
    },

    updateMeal() {
      this.$axios
        .put("/api/meals/" + this.meal.id, this.meal)
        .then((response) => {
          this.meal = response.data.resource;
          this.messages = response.data;
          if (this.redirectToIndex) {
            this.$router.push({ name: "meals.index" });
          }
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.formErrors = error.response.data.errors;
          }
        });
    },

    async handleImage(event) {
      // Get the previes and show it
      this.image = event.target.files[0];
      const reader = new FileReader();
      reader.readAsDataURL(this.image);
      reader.onload = (e) => {
        this.previewImage = e.target.result;
      };
      this.redirectToIndex = false;

      // Create the meal and get id first
      if (!this.meal.id) {
        await this.$axios
          .post("/api/meals", this.meal)
          .then((response) => {
            this.meal = response.data.resource;
            //this.storeImage();
          })
          .catch((error) => {
            if (error.response.status == 422) {
              this.formErrors = error.response.data.errors;
            }
          });
      }
      // else {
      this.storeImage();
      // }
    },

    // the actual upload
    storeImage() {
      let formData = new FormData();
      formData.set("meal_id", this.meal.id);

      // Meal id to delete old one from db
      if (this.getImageId()) {
        formData.set("image_id", this.meal.images[0].id);
      }

      formData.append("image", this.image);
      formData.append("_token", this.csrfToken);

      let self = this;

      this.$axios
        .post("/api/meal/image", formData, {
          headers: { "Content-type": "application/x-www-form-urlencoded" },
          onUploadProgress(progressEvent) {
            var percentCompleted = Math.round(
              (progressEvent.loaded * 100) / progressEvent.total
            );
            self.uploadPercentage = percentCompleted;
          },
        })
        .then((response) => {
          this.message = response.data;
          this.previewImage = null;
          this.meal = response.data.resource;
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.formErrors = error.response.data.errors;
          }
        });
    },

    deleteMeal() {
      if (confirm("Do you really want to delete?")) {
        this.deleteMealMixin(this.id);
        this.$router.push({ name: "meals.index" });
      }
    },

    deleteImage(imageId) {
      this.$axios
        .delete("/api/meal/image/" + imageId)
        .then((response) => {
          this.message = response.data;
          this.meal = response.data.resource;
          this.previewImage = null;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },

  mounted() {
    this.csrfToken = document.querySelector('meta[name="csrf-token"]').content;
  },

  created() {
    this.handleRouter();
  },
};
</script>
