<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, Link } from '@inertiajs/vue3'
import { dashboard } from '@/routes'
import users from '@/routes/users'               // ✅ helper users
import { type BreadcrumbItem } from '@/types'
import PlaceholderPattern from '../components/PlaceholderPattern.vue'

import Button from 'primevue/button'

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: dashboard().url },
]
</script>

<template>
  <Head title="Dashboard" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
      <div class="grid auto-rows-min gap-4 md:grid-cols-3">
        <!-- tes cartes existantes -->
        <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
          <PlaceholderPattern />
          <div class="absolute inset-0 flex items-center justify-center">
            <Button label="PrimeVue OK" icon="pi pi-check" />
          </div>
        </div>
        <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
          <PlaceholderPattern />
        </div>

        <!-- ✅ Carte Users -->
        <Link
          :href="users.index().url"   
          class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 p-5 hover:shadow dark:border-sidebar-border"
        >
          <div class="text-sm text-muted-foreground">Administration</div>
          <div class="mt-2 text-xl font-semibold">Users</div>
          <p class="mt-1 text-muted-foreground">Gérer les utilisateurs</p>
        </Link>
      </div>

      <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
        <PlaceholderPattern />
      </div>
    </div>
  </AppLayout>
</template>
