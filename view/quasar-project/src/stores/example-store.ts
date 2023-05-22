import { defineStore } from 'pinia'
import Swal from 'sweetalert2'
import * as yup from 'yup'

export const store = defineStore('counter', {
  state: () => ({
    university_schema: yup.object({
      university_id: yup.number().required(),
      university_name: yup.string().required().min(1).max(200),
      university_location: yup.string().required().min(1).max(200)
    }),
    room_schema: yup.object({
      room_id: yup.number().required(),
      university_name: yup.string().required().min(1).max(200),
      room_type: yup.string().required().min(1).max(200),
      room_state: yup.string().required().min(1).max(200)
    })
  }),
  getters: {
    doubleCount: (state) => state.counter * 2
  },
  actions: {
    notify (icons: string, titles: string) {
      Swal.fire({
        icon: icons.toString(),
        title: titles.toString(),
        showConfirmButton: false,
        timer: 2500
      })
    },
    async actioner (controller: string, action: string, callback: any) {
      const query = await fetch(`http://localhost:5000?controller=${controller}&action=${action}`)
      const answer = await query.json()
      const iconType = answer.answer === 'ok' ? 'success' : 'warning'
      callback(iconType, answer.answer)
    },
    async handler (url: string, callback: any) {
      const query = await fetch(url)
      const answer = await query.json()
      const icontype = 'warning'
      callback(icontype, answer.answer)
    }
  }
})
