<template>
    <div>
        <input type="text" v-model="item.name" />
        <input type="number" v-model="item.price" />
        <button @click="removeItem()">-</button>
    </div>
</template>

<script>
  export default {
    name: 'Item',
    props: {
      value: {
        type: Object,
        required: true
      }
    },
    data: function () {
      return {
        item: {
          name: null,
          price: null
        }
      }
    },
    created() {
      this.item = this.value
    },
    watch: {
      item: {
        handler() {
          this.$emit('input', this.item)
        },
        deep: true
      },
      value: {
        handler() {
          this.item = this.value
        },
        deep: true
      }
    },
    methods: {
      removeItem() {
        this.$emit('remove')
      }
    }
  }
</script>
