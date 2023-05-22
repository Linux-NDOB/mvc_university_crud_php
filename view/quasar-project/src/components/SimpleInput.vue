<template>
  <q-input
    class='text-white'
    label-color="black"
    outlined
    rounded
    v-model="value"
    :error-message="errorMessage"
    :error="!!errorMessage"
>
<template v-slot:prepend>
  <slot></slot>
        </template>
  </q-input>
 </template>

<script setup lang="ts">
import { defineProps, toRef } from 'vue'
import { useField } from 'vee-validate'

const props = defineProps({
  name: {
    type: String,
    required: true
  }
})

const { errorMessage, value } = useField(toRef(props, 'name'))
</script>
