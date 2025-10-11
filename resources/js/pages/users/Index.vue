<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'
import { dashboard } from '@/routes'
import type { BreadcrumbItem } from '@/types'
import users from '@/routes/users'

// props (adapté à ta pagination serveur)
type User = { id:number; name:string; email:string; created_at?:string; status?:'active'|'pending'|'blocked' }
type Paginator<T> = { data:T[]; links:any[]; from:number|null; to:number|null; total:number }
const props = defineProps<{ users: Paginator<User> }>()

const breadcrumbs: BreadcrumbItem[] = [
  { title: 'Dashboard', href: dashboard().url },
  { title: 'Users',     href: users.index().url },
]
</script>

<template>
  <Head title="Users" />

  <!-- ✅ Utilise le layout du dashboard -->
  <AppLayout :breadcrumbs="breadcrumbs">
    <!-- 👇 ton tableau existant ici -->
    <div class="rounded-2xl border border-gray-200 bg-white/60 backdrop-blur p-4 md:p-5">
      <h2 class="mb-4 text-lg font-semibold">Users</h2>

      <div class="overflow-x-auto">
        <table class="min-w-full text-left text-sm">
          <thead class="text-xs uppercase text-gray-500">
            <tr>
              <th class="px-3 py-2.5">ID</th>
              <th class="px-3 py-2.5">Name</th>
              <th class="px-3 py-2.5">Email</th>
              <th class="px-3 py-2.5">Joined</th>
              <th class="px-3 py-2.5">Status</th>
              <th class="px-3 py-2.5 text-right">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            <tr v-for="u in props.users.data" :key="u.id">
              <td class="px-3 py-3">#{{ u.id }}</td>
              <td class="px-3 py-3 font-medium">{{ u.name }}</td>
              <td class="px-3 py-3">{{ u.email }}</td>
              <td class="px-3 py-3">{{ (u.created_at ?? '').slice(0,10) || '—' }}</td>
              <td class="px-3 py-3">
                <span class="inline-flex items-center rounded-full bg-emerald-100 px-2.5 py-1 text-xs font-medium text-emerald-700 ring-1 ring-emerald-200">active</span>
              </td>
              <td class="px-3 py-3 text-right">
                <!-- actions -->
                <button class="rounded-lg border px-2.5 py-1.5 text-xs hover:bg-gray-50">View</button>
                <button class="rounded-lg border px-2.5 py-1.5 text-xs hover:bg-gray-50">Edit</button>
                <button class="rounded-lg bg-rose-600 px-2.5 py-1.5 text-xs text-white hover:bg-rose-700">Delete</button>
              </td>
            </tr>
            <tr v-if="props.users.data.length === 0">
              <td colspan="6" class="px-3 py-6 text-center text-gray-500">No users.</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- pagination Inertia/Laravel si tu veux rendre les liens -->
      <!-- <nav class="mt-4 flex gap-2">
        <Link v-for="l in props.users.links" :key="l.label" :href="l.url || '#'"
              :class="['px-3 py-1.5 rounded', l.active ? 'bg-gray-900 text-white' : 'border hover:bg-gray-50']"
              v-html="l.label" />
      </nav> -->
    </div>
  </AppLayout>
</template>
