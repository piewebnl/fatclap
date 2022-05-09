<template>
  <div>
    <Heading title="Cookbook"></Heading>

    <form
      @submit.prevent
      @keypress.enter.prevent
      v-if="showForm"
      class="border rounded-xl p-6 bg-white"
    >
      <input type="hidden" v-model="id" name="id" readonly />

      <div class="mb-6">
        <label for="name">Cookbook name</label>
        <div>
          <input type="text" name="name" v-model="name" />
          <FormErrorMessages :formErrors="formErrors.name"></FormErrorMessages>
        </div>
      </div>
      <div class="flex flex-row flex-wrap w-full justify-end mt-4">
        <Button
          v-if="id"
          @emitClicked="deleteCookbook()"
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

export default {
  components: {
    Button,
    Heading,
    FormErrorMessages,
  },

  data() {
    return {
      cookbooks: [],
      id: null,
      name: "",
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
        this.fetchCookbook();
      } else {
        this.showForm = true;
      }
    },

    formSubmit() {
      if (this.id) {
        this.updateCookbook();
      } else {
        this.storeCookbook();
      }
    },

    setFormData() {
      return {
        id: this.id,
        name: this.name,
      };
    },

    fetchCookbook() {
      this.$axios
        .get("/api/cookbooks/" + this.id)
        .then((response) => {
          this.id = response.data.id;
          this.name = response.data.name;
          this.showForm = true;
        })
        .catch((error) => {
          this.messages = error.response.data;
        });
    },

    storeCookbook() {
      this.$axios
        .post("/api/cookbooks", this.setFormData())
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

    updateCookbook() {
      this.$axios
        .put("/api/cookbooks/" + this.id, this.setFormData())
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

    deleteCookbook() {
      if (confirm("Do you really want to delete?")) {
        this.$axios
          .delete("/api/cookbooks/" + this.id)
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
