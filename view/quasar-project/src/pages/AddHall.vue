<template lang="pug">
h3.text-center Ocupar Salon
Form(:validation-schema='roomSchema', class='form-container q-mx-sm text-white text-center grid justify-content-center')
    .container.col-6.offset-col-3.formgroup-inline
      Input(label="# Salon", :name="'room_id'", class="col-12", v-model="formData.room_id")
        q-icon(name='group_add')
      Input(label="Nombre universidad", :name="'university_name'", class="col-12", v-model="formData.university_name")
       q-icon(name='group_add')
      VeeSelect(rounded, outlined, label='Tipo', :name="'room_type'", :options="roomType", class="col-6", v-model="formData.room_type", @click='getState')
       q-icon(name='group_add')
      VeeSelect(rounded, outlined, label='Estado', :name="'room_state'", :options="roomState", class="col-6", v-model="formData.room_state")
         q-icon(name='group_add')
      div.q-pa-md.q-gutter-sm.q-mb-md.justify-content-center.col-12
        q-btn(type='submit', class='q-mb-md align-content-center', color='indigo', icon='save', label='Agregar-Editar', @click="validateForm")
    .q-pa-md

.grid
  .col-10.col-offset-1.justify-content-center
    table.col-12.align-items-center.justify-content-center.table
      thead
        tr
          th id universidad
          th Nombre
          th Localizacion
          th Eliminar
      tbody
        tr(v-for= "row in rows " :key="row.room_id", class='justify-items-center' class='justify-items-center text-center')
            td {{row.room_id}}
            td {{row.university_name}}
            td {{row.room_type}}
            td
              q-btn(class='align-content-center' color='indigo' label='Eliminar', @click="drop(row.room_id)")
            td
</template>

<script setup lang="ts">
import Input from '../components/SimpleInput.vue'
import VeeSelect from '../components/SelectInput.vue'
import { Form } from 'vee-validate'
import { onMounted, ref } from 'vue'
import { store } from '../stores/example-store'
import * as yup from 'yup'

const ustore = store()

const roomSchema = ustore.room_schema

const rows = ref({})

const availableRooms = ref(0)
const formData = ref({
  room_id: "",
  university_name: "",
  room_type: "",
  room_state: ""
})

const roomType = ['Estandar', 'Auditorio', 'VideoConferencia']

const roomState = ref(['vacio'])

const getState = () => {
  roomState.value = []
  const standart = ['Sencillo', 'Amoblado']
  const auditorium = ['Mediano', 'Grande']
  const videoConference = ['Sencillo', 'Amoblado', 'Mediano']

  if (formData.value.room_type === 'Estandar') {
    roomState.value.push(...standart)
  } else if (formData.value.room_type === 'Auditorio') {
    roomState.value.push(...auditorium)
  } else {
    roomState.value.push(...videoConference)
  }
}

const storeRoom = async () => ustore.handler(`http://localhost:5000?controller=Room&action=store&room_id=${formData.value.room_id}&university_name=${formData.value.university_name}&room_type=${formData.value.room_type}-${formData.value.room_state}`, ustore.notify)

const validateForm = () => {
  roomSchema.validate(formData.value).then((valid) => {
    console.log(availableRooms.value)
    availableRooms.value <= 49 ? storeRoom() : ustore.notify('error', 'No se pueden aniadir mas')
    get()
  }).catch((err) => {
    console.log(err)
  })
}

const get = async () => {
  const query = await fetch('http://localhost:5000?controller=Room&action=fetch')
  const answer = await query.json()
  rows.value = answer.answer
  availableRooms.value = Object.keys(answer.answer).length
}

const drop = async (roomId: number) => {
  const action = await ustore.handler(`http://localhost:5000?controller=Room&action=deletes&room_id=${roomId}&university_name=null&room_type=null`, ustore.notify)
  get()
}

onMounted(() => {
  get()
})
</script>

<style lang="scss">
.table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 1rem;

  th, td {
    padding: 0.75rem;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }

  th {
    background-color: #f5f5f5;
  }

  tbody tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
  }

  tbody tr:hover {
    background-color: #f5f5f5;
  }
}

</style>
