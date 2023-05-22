<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          />

        <q-toolbar-title>
          CRUD Universidades
        </q-toolbar-title>

        <div>Quasar v{{ $q.version }}</div>
      </q-toolbar>

<q-tabs align='left'>
        <q-route-tab to='/' label='Informacion del hotel' />
        <q-route-tab to='/add_university' label='Crear Universidad' />
        <q-route-tab to='/add_hall' label='Ocupar Salon' />
        </q-tabs>
    </q-header>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>
