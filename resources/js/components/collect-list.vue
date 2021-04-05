<template>
  <CDataTable
      hover
      striped
      :items="items"
      :fields="fields"
      :items-per-page="20"
      pagination
      :addTableClasses="min-width"
  >
  </CDataTable>
</template>

<script>
    export default {
        props: {
          fields: Array,
          items: Array,
        },
        mounted() {
            console.log(this.items)
        }
    }
</script>
