<template lang="pug">
h3.text-center Agregar Universidad
Form(:validation-schema='universitySchema', class='form-container q-mx-sm text-white text-center grid justify-content-center')
    .container.col-6.offset-col-3.formgroup-column
      Input(label="ID", :name="'university_id'", class="col-12", v-model="formData.university_id")
        q-icon(name='group_add')
      Input(label="Nombre", :name="'university_name'", class="col-12", v-model="formData.university_name")
       q-icon(name='group_add')
      Input(label="Localizacion", :name="'university_location'", class="col-12", v-model="formData.university_location")
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
        tr(v-for= "row in rows " :key="row.university_id", class='justify-items-center' class='justify-items-center text-center')
            td {{row.university_id}}
            td {{row.university_name}}
            td {{row.university_location}}
            td
              q-btn(class='align-content-center' color='indigo' label='Eliminar', @click="drop(row.university_id)")
            td
</template>

<script setup lang="ts">
import Input from '../components/SimpleInput.vue'
import { Form } from 'vee-validate'
import { onMounted, ref } from 'vue'
import { store } from '../stores/example-store'
import * as yup from 'yup'

const ustore = store()

const universitySchema = ustore.university_schema

const rows = ref({})

const formData = ref({
  university_id: "",
  university_name: "",
  university_location: ""
})

const storeUniversity = async () => ustore.handler(`http://localhost:5000?controller=University&action=store&university_id=${formData.value.university_id}&university_name=${formData.value.university_name}&university_location=${formData.value.university_location}`, ustore.notify)

const validateForm = () => {
  universitySchema.validate(formData.value).then((valid) => {
    storeUniversity()
    get()
  }).catch((err) => {
    console.log(err)
  })
}

const get = async () => {
  const query = await fetch('http://localhost:5000?controller=University&action=fetch')
  const answer = await query.json()
  rows.value = answer.answer
  console.log(answer)
}

const drop = async (universityId: number) => {
  const action = await ustore.handler(`http://localhost:5000?controller=University&action=deletes&university_id=${universityId}&university_name=null&university_location=null`, ustore.notify)
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
