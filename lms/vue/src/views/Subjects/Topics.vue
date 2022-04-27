<template>
    <div class="grid grid-cols-12 gap-12">
      <!-- BEGIN: Chapters list -->
      <div class="intro-y box col-span-12 lg:col-span-12">
        <div
          class="
            flex
            items-center
            px-5
            py-5
            sm:py-3
            border-b border-slate-200/60
            dark:border-darkmode-400
          "
        >
          <h2 class="font-medium text-base mr-auto">Topics</h2>
          <Dropdown class="ml-auto sm:hidden">
            <DropdownToggle tag="a" class="w-5 h-5 block" href="javascript:;">
              <MoreHorizontalIcon class="w-5 h-5 text-slate-500" />
            </DropdownToggle>
            <DropdownMenu class="w-40">
              <DropdownContent>
                <DropdownItem>
                  <FileIcon class="w-4 h-4 mr-2" /> Download Excel
                </DropdownItem>
              </DropdownContent>
            </DropdownMenu>
          </Dropdown>
          <button class="btn btn-outline-secondary hidden sm:flex">
            <FileIcon class="w-4 h-4 mr-2" /> Download Excel
          </button>
        </div>
        <div class="p-5">
          <div class="relative flex items-center mt-5">
            <div class="ml-4 mr-auto">
              <a href="" class="font-medium">Label</a>
              <div class="text-slate-500 mr-5 sm:mr-5">Tags</div>
            </div>
            <div class="font-medium text-slate-600 dark:text-slate-500">
              Action
            </div>
          </div>

          
        </div>
      </div>
      <!-- END: Chapters list -->
    </div>
</template>

<script setup>
</script>

<style>
</style>