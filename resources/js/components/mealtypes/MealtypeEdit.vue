<template>
  <div>
    <Heading title="Mealtype"></Heading>

    <form
      @submit.prevent
      @keypress.enter.prevent
      v-if="showForm"
      class="border rounded-xl p-6 bg-white"
    >
      <input type="hidden" v-model="id" name="id" readonly />

      <div class="mb-6">
        <label for="name">Mealtype name</label>
        <div>
          <input type="text" name="name" v-model="name" />
          <FormErrorMessages :formErrors="formErrors.name"></FormErrorMessages>
        </div>
      </div>
      <div class="mb-6">
        <label for="color">Pick a new light color</label>
        <div>
          <v-swatches v-model="color" :swatches="swatches"></v-swatches>
        </div>
      </div>
      <div class="flex flex-row flex-wrap w-full justify-end mt-4">
        <Button
          v-if="id"
          @emitClicked="deleteMealtype()"
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
    </form>
  </div>
</template>

<script>
import Button from "@/components/buttons/Button";
import Heading from "@/components/headings/Heading";
import FormErrorMessages from "@/components/messages/FormErrorMessages";
import VSwatches from "vue-swatches";
import "vue-swatches/dist/vue-swatches.css";

export default {
  components: {
    Button,
    Heading,
    FormErrorMessages,
    VSwatches,
  },

  data() {
    return {
      mealtypes: [],
      id: null,
      name: "",
      color: "", //rgba(122,194,145, 1)
      swatches: [
        "#ffebee",
        "#fce4ec",
        "#f3e5f5",
        "#ede7f6",
        "#e8eaf6",
        "#e3f2fd",
        "#e1f5fe",
        "#e0f7fa",
        "#e0f2f1",
        "#e8f5e9",
        "#f1f8e9",
        "#f9fbe7",
        "#fffde7",
        "#fff8e1",
        "#fff3e0",
        "#fbe9e7",
        "#efebe9",
        "#fafafa",
        "#eceff1",
      ], // tailwind -50 colours
      formErrors: [],
      showForm: false,
    };
  },

  computed: {
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
      this.id = this.$route.params.id;
      if (this.id) {
        this.fetchMealtype();
      } else {
        this.showForm = true;
      }
    },

    formSubmit() {
      if (this.id) {
        this.updateMealtype();
      } else {
        this.storeMealtype();
      }
    },

    setFormData() {
      return {
        id: this.id,
        name: this.name,
        color: this.color,
      };
    },

    fetchMealtype() {
      this.$axios
        .get("/api/mealtypes/" + this.id)
        .then((response) => {
          this.id = response.data.id;
          this.name = response.data.name;
          this.color = response.data.color;
          this.showForm = true;
        })
        .catch((error) => {
          this.messages = error.response.data;
        });
    },

    storeMealtype() {
      this.$axios
        .post("/api/mealtypes", this.setFormData())
        .then((response) => {
          this.messages = response.data;
          this.$router.back();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.formErrors = error.response.data.errors;
          } else {
            this.messages = error.response.data;
          }
        });
    },

    updateMealtype() {
      this.$axios
        .put("/api/mealtypes/" + this.id, this.setFormData())
        .then((response) => {
          this.messages = response.data;
          this.$router.back();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.formErrors = error.response.data.errors;
          } else {
            this.messages = error.response.data;
          }
        });
    },

    deleteMealtype() {
      if (confirm("Do you really want to delete?")) {
        this.$axios
          .delete("/api/mealtypes/" + this.id)
          .then((response) => {
            this.messages = response.data;
            this.$router.back();
          })
          .catch((error) => {
            this.messages = error.response.data;
          });
      }
    },
  },
  created() {
    this.handleRouter();
  },
};
</script>
