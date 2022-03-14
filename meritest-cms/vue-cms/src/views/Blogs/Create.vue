<template>
  <div>
    <div class="md:grid md:grid-cols-4 md:gap-8">
      <div class="mt-5 md:mt-0 md:col-span-4">
        <form @submit.prevent="submit">
          <div class="shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <div class="grid grid-cols-3 gap-6">
                <div class="col-span-3 sm:col-span-4">
                  <label
                    for="company-website"
                    class="block text-sm font-medium text-gray-700"
                  >
                    Title
                  </label>
                  <div class="mt-1 flex rounded-md shadow-sm">
                    <input
                      type="text"
                      name="company-website"
                      id="company-website"
                      v-model="form.title"
                      class="
                        focus:ring-indigo-500 focus:border-indigo-500
                        flex-1
                        block
                        w-full
                        rounded-none rounded-r-md
                        sm:text-sm
                        border-gray-300
                      "
                      placeholder="Title of blog"
                    />
                  </div>
                </div>
              </div>
              <div class="col-span-6 sm:col-span-3">
                <label
                  for="blog-category"
                  class="block text-sm font-medium text-gray-700"
                  >Category</label
                >
                <select
                  id="blog-category"
                  name="country"
                  v-model="form.blog_category_id"
                  autocomplete="country-name"
                  class="
                    mt-1
                    block
                    w-full
                    py-2
                    px-3
                    border border-gray-300
                    bg-white
                    rounded-md
                    shadow-sm
                    focus:outline-none
                    focus:ring-indigo-500
                    focus:border-indigo-500
                    sm:text-sm
                  "
                >
                  <option
                        v-for="category in categories"
                        :key="category.id"
                        :value="category.id"
                      >
                        {{ category.name }}
                    </option>
                </select>
              </div>
              <div>
                <label
                  for="content"
                  class="block text-sm font-medium text-gray-700"
                >
                  Content
                </label>
                <div class="mt-1">
                  <editor
                    id="content"
                    v-model="form.content"
                    initialValue="<p>Initial editor content</p>"
                    apiKey="n10p1o42akootxkapivj4ecxefdo4zlaqd0ek0aa47ld9js7"
                    :init="{
                        height: 500,
                        menubar: true,
                        plugins: [
                            'advlist autolink lists link image charmap',
                            'searchreplace visualblocks code fullscreen',
                            'print preview anchor insertdatetime media',
                            'paste code help wordcount table powerpaste',
                        ],
                        toolbar:
                            'undo redo | formatselect | bold italic | \
                            alignleft aligncenter alignright | \
                            bullist numlist outdent indent | insert | help | \
                            tiny_mce_wiris_formulaEditor | tiny_mce_wiris_formulaEditorChemistry',
                    }"
                    >
                </editor>
                </div>
              </div>

            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button
                type="submit"
                class="
                  inline-flex
                  justify-center
                  py-2
                  px-4
                  border border-transparent
                  shadow-sm
                  text-sm
                  font-medium
                  rounded-md
                  text-white
                  bg-indigo-600
                  hover:bg-indigo-700
                  focus:outline-none
                  focus:ring-2
                  focus:ring-offset-2
                  focus:ring-indigo-500
                "
              >
                Save
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import Editor from '@tinymce/tinymce-vue'

import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import { ref } from "vue";
import store from "@/store";

//const editor = Editor.component;

const form = {
  title: "",
  content: "",
  blog_category_id: null,
  is_active: true,
};

const categories = [
  {
    id: 1,
    name: "Exams",
  },
  {
    id: 2,
    name: "Study Material",
  },
];
function submit() {
    store
    .dispatch("blogs/create", form)
    .then(() => {
      //loading.value = false;
      router.push({
        name: "Blogs",
      });
    })
    .catch((err) => {
      //loading.value = false;
      errorMsg.value = err.response.data.message;
    });
}
</script>

<style>
</style>