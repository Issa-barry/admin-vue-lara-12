<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'
import { dashboard } from '@/routes'
import users from '@/routes/users'

const breadcrumbs = [
  { title: 'Dashboard', href: dashboard().url },
  { title: 'Users', href: users.index().url },
  { title: 'Create'},
]
</script>

<template>
  <Head title="Create user" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="p-4 md:p-6 lg:p-8">
      <div class="rounded-2xl border bg-white/70 p-5 md:p-6">
        <h1 class="mb-1 text-xl font-semibold">Create user</h1>
        <p class="mb-6 text-sm text-gray-500">
          Renseignez les informations de l’utilisateur. (Aucune logique, juste la mise en page)
        </p>

        <form class="space-y-6">
          <!-- Rôle -->
          <div class="grid gap-2">
            <label class="text-sm font-medium">Rôle</label>
            <select class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 focus:border-gray-400 focus:outline-none">
              <option value="">Sélectionner un rôle</option>
              <option>Admin</option>
              <option>Manager</option>
              <option>Vendeur</option>
              <option>Comptable</option>
              <option>Packing</option>
            </select>
          </div>

          <!-- Nom & Prénom -->
          <div class="grid gap-4 md:grid-cols-2">
            <div class="grid gap-2">
              <label class="text-sm font-medium">Nom</label>
              <input type="text" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-gray-400 focus:outline-none" placeholder="Ex: Barry" />
            </div>
            <div class="grid gap-2">
              <label class="text-sm font-medium">Prénom</label>
              <input type="text" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-gray-400 focus:outline-none" placeholder="Ex: Issa" />
            </div>
          </div>

          <!-- Téléphone & Email -->
          <div class="grid gap-4 md:grid-cols-2">
            <div class="grid gap-2">
              <label class="text-sm font-medium">Téléphone</label>
              <input type="tel" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-gray-400 focus:outline-none" placeholder="+223 65 00 00 00" />
            </div>
            <div class="grid gap-2">
              <label class="text-sm font-medium">Email</label>
              <input type="email" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-gray-400 focus:outline-none" placeholder="email@domaine.com" />
            </div>
          </div>

          <!-- Ville & Quartier -->
          <div class="grid gap-4 md:grid-cols-2">
            <div class="grid gap-2">
              <label class="text-sm font-medium">Ville</label>
              <input type="text" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-gray-400 focus:outline-none" placeholder="Ex: Bamako" />
            </div>
            <div class="grid gap-2">
              <label class="text-sm font-medium">Quartier</label>
              <input type="text" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-gray-400 focus:outline-none" placeholder="Ex: ACI 2000" />
            </div>
          </div>

          <!-- Actions -->
          <div class="flex items-center gap-3 pt-2">
            <button type="button" class="rounded-lg border px-4 py-2 text-sm hover:bg-gray-50">
              Annuler
            </button>
            <button type="button" class="rounded-lg bg-gray-900 px-4 py-2 text-sm text-white hover:bg-black">
              Enregistrer
            </button>
          </div>
        </form>
      </div>
    </div>
  </AppLayout>
</template>
