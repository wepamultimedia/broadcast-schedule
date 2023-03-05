<script>
import MainLayout from "@pages/Vendor/Core/Backend/Layouts/MainLayout/MainLayout.vue";

export default {
    layout: (h, page) => h(MainLayout, {
        title: "programs",
        bc: [{label: "programs"}]
    }, () => page)
};
</script>
<script setup>
import { Link } from "@inertiajs/vue3";
import Table from "@core/Components/Table.vue";

defineProps(["programs"]);

</script>
<template>
    <div class="flex justify-between my-0 items-center h-14 rounded-lg overflow-hidden my-6">
        <span class="text-skin-base  font-medium text-xl">{{ __("programs_list") }}</span>
        <Link :href="route('admin.broadcast-schedule.programs.create')"
              as="button"
              class="btn btn-success text-sm"
              type="button">{{ __("create") }}
        </Link>
    </div>
    <div class="w-full
                    bg-white dark:bg-gray-700
                    overflow-hidden
                    shadow
                    text-skin-base
                    rounded-lg
                    mb-20">
        <Table :columns="[{name: 'image', show: 'md'}, {name: 'name', class: 'w-full'}]"
               :data="programs"
               delete-route="admin.broadcast-schedule.programs.destroy"
               edit-route="admin.broadcast-schedule.programs.edit"
               even
               search-route="admin.broadcast-schedule.programs.index">
            <template #col-content-image="{item}">
                <div class="w-20 mx-1">
                    <img :src="item.image" class="h-16 w-16 rounded-full"
                         :alt="item.title">
                </div>
            </template>
        </Table>
    </div>
</template>
<style lang="scss"
       scoped></style>
