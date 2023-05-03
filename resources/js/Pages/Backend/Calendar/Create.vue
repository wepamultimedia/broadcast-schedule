<script>
import MainLayout from "@pages/Vendor/Core/Backend/Layouts/MainLayout/MainLayout.vue";

export default {
    layout: (h, page) => h(MainLayout, {
        title: "calendar",
        bc: [{label: "calendar", route: "admin.broadcast-schedule.calendars.index"}, {label: "create"}]
    }, () => page)
};
</script>
<script setup>
import Input from "@core/Components/Form/Input.vue";
import Textarea from "@core/Components/Form/Textarea.vue";
import { useForm } from "@inertiajs/vue3";
import SaveFormButton from "@core/Components/Form/SaveFormButton.vue";
import { __ } from "@core/Mixins/translations";
import Select from "@core/Components/Select.vue";
import { useStore } from "vuex";
import Checkbox from "@core/Components/Form/Checkbox.vue";

const props = defineProps(["programs", "errors", "day"]);

const store = useStore();
const weekday = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];
const weekdayItems = weekday.map(wd => {
    return {id: wd, label: wd};
});
const programItems = props.programs.map(program => {
    return {id: program.id, label: program.name};
});

const form = useForm({
    program_id: null,
    description: null,
    day: props.day,
    time: null,
    highlight: false
});

function submit() {
    form.post(route("admin.broadcast-schedule.calendars.store"), {
        preserveScroll: true, preserveState: true,
        onSuccess: () => store.dispatch("backend/addAlert", {type: "success", message: __("saved")}),
        onError: () => store.dispatch("backend/addAlert", {type: "error", message: form.errors})
    });
}
</script>
<template>
    <div class="flex justify-between my-0 items-center h-14 rounded-lg overflow-hidden mt-4">
        <span class="dark:text-light font-medium text-xl">{{ __("create_title") }}</span>
    </div>
    <form @submit.prevent="submit">
        <div class="max-w-7xl">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 text-skin-base ">
                <div class="col-span-1">
                    <p class="text-sm"
                       v-html="__('create_summary')"></p>
                </div>
                <div class="col-span-2
                        border
                        dark:border-gray-600
                        bg-white dark:bg-gray-600
                        rounded-lg
                        shadow">
                    <div class="grid grid-cols-6 p-6">
                        <div class="col-span-6 sm:col-span-6 lg:col-span-5 xl:col-span-4 mb-6">
                            <Select v-model="form.day"
                                    :errors="errors"
                                    :label="__('select_day')"
                                    :options="weekdayItems"
                                    class="mb-2"
                                    name="day"
                                    required
                                    translate-label/>
                        </div>
                        <div class="col-span-6 sm:col-span-6 lg:col-span-5 xl:col-span-4 mb-6">
                            <Select v-model="form.program_id"
                                    :errors="errors"
                                    :label="__('select_program')"
                                    :options="programItems"
                                    class="mb-2"
                                    name="program_id"
                                    required
                                    searcheable/>
                        </div>
                        <div class="col-span-6 mb-6">
                            <Textarea v-model="form"
                                      :errors="form.errors"
                                      :label="__('description')"
                                      name="description"/>
                        </div>
                        <div class="col-span-full mb-6">
                            <div class="col-span-3">
                                <Input v-model="form"
                                       :errors="form.errors"
                                       :label="__('time')"
                                       name="time"
                                       required
                                       type="time"/>
                            </div>
                        </div>
                        <div class="col-span-3">
                            <Checkbox v-model="form.highlight"
                                      :label="__('highlight')"
                                      :name="__('highlight')"/>
                        </div>
                    </div>
                    <div class="rounded-b-lg overflow-hidden">
                        <div class="p-3 bg-gray-200 dark:bg-gray-500 flex justify-end">
                            <SaveFormButton :form="form"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>
