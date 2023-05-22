<template lang="pug">
.card
  .flex.justify-content-center.flex-column
      h2.align-self-center Crear Hotel
  p.align-self-center.text-center.col-8.col-offset-2 Al cargarse este componente se ha creado y rellenado la tabla hotel, la cual tiene un hotel llamado Hotel Real y cuenta con 50 salones disponibles, tambien se ha creado la tabla universidad y la tabla salon, la cual puede ser ocupada por una universidad, las universidades no se pueden repetir.
.</template>

<script setup lang="ts">
import { onMounted } from 'vue'
import { store } from '../stores/example-store'

const ustore:any = store()

const action = (controller: string, action: string) => ustore.actioner(controller, action, ustore.notify)

onMounted(() => {
  // create table hotel
  action('Hotel', 'create')
  // fill table hotel
  action('hotel', 'fill')
  // create table university
  action('University', 'create')
  // create table Hall
  action('Room', 'create')
})
</script>
