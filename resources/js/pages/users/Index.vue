<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import { Head, router } from '@inertiajs/vue3'

import DataTable from 'primevue/datatable'
import Column from 'primevue/column'
import InputText from 'primevue/inputtext'
import Button from 'primevue/button'
import Tag from 'primevue/tag'
import Avatar from 'primevue/avatar'
import Menu from 'primevue/menu'
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'

import IconField from 'primevue/iconfield'
import InputIcon from 'primevue/inputicon'


import { dashboard } from '@/routes'
import users from '@/routes/users'

type User = { id: number; name: string; email: string; created_at?: string }
type Paginator<T> = { data: T[]; total: number; links: any[] }

const props = defineProps<{
  users: Paginator<User>
  q?: string
  rows?: number
  sort?: string
  order?: 'asc' | 'desc'
}>()

/* ------- helpers UI (fake fields pour démo) ------- */
const handle = (n: string) => '@' + n.toLowerCase().replace(/\s+/g, '.')
const locationOf = (id: number) =>
  ['New York, USA', 'London, UK', 'Paris, France', 'Berlin, Germany', 'Sydney, Australia'][id % 5]
const statusOf = (id: number) => ['Subscribed', 'Unsubscribed', 'Bounced'][id % 3]
const statusSeverity = (s: string) =>
  ({ Subscribed: 'success', Unsubscribed: 'danger', Bounced: 'warn' } as any)[s] ?? 'info'

/* ------- sélection & actions ------- */
const selection = ref<User[] | null>(null)
const actions = ref<any>()
const currentRow = ref<User | null>(null)
const openActions = (event: Event, row: User) => {
  currentRow.value = row
  actions.value?.toggle(event)
}
const actionItems = [
  { label: 'Copy customer ID', icon: 'pi pi-copy', command: () => navigator.clipboard?.writeText(String(currentRow.value?.id)) },
  { separator: true },
  { label: 'View customer details', icon: 'pi pi-user' },
  { label: 'View customer payments', icon: 'pi pi-credit-card' },
  { separator: true },
  { label: 'Delete customer', icon: 'pi pi-trash', class: 'text-red-600', command: () => {/* TODO */} },
]

/* ------- server-side interactions (Inertia) ------- */
const reload = (params: Record<string, any>) =>
  router.get(
    users.index().url,
    { q: props.q, rows: props.rows, sort: props.sort, order: props.order, ...params },
    { preserveState: true, replace: true }
  )

const onPage = (e: any) => reload({ page: e.page + 1, rows: e.rows })
const onSort = (e: any) => reload({ sort: e.sortField, order: e.sortOrder === 1 ? 'asc' : 'desc' })
const onSearch = (val: string | undefined) => {
  reload({ q: val ?? '', page: 1 })
}

</script>

<template>
  <Head title="Users" />
  <AppLayout :breadcrumbs="[{ title: 'Dashboard', href: dashboard().url }, { title: 'Users', href: users.index().url }]">
    <div class="p-4 md:p-6 lg:p-8">
      <!-- Toolbar -->
      <!-- Toolbar (sans bouton Delete) -->
<div class="mb-3 flex items-center justify-between gap-3">
  <!-- Recherche à gauche -->
  <IconField iconPosition="left" class="w-full max-w-sm">
    <InputIcon class="pi pi-search" />
    <InputText
      :value="props.q"
      placeholder="Filter emails or names…"
      @update:modelValue="onSearch"
      class="w-full"
    />
  </IconField>

  <!-- Actions à droite -->
  <div class="flex items-center gap-2">
    <Button label="Display" icon="pi pi-sliders-h" outlined />
     <Link :href="users.create().url">
    <Button label="Nouveau" icon="pi pi-plus" />
  </Link>
  </div>
</div>


      <!-- Table -->
      <DataTable
        :value="props.users.data"
        dataKey="id"
        lazy
        paginator
        :totalRecords="props.users.total"
        :rows="props.rows ?? 10"
        :rowsPerPageOptions="[10, 25, 50]"
        @page="onPage"
        :sortField="props.sort ?? 'id'"
        :sortOrder="(props.order ?? 'desc') === 'asc' ? 1 : -1"
        sortMode="single"
        @sort="onSort"
        v-model:selection="selection"
        selectionMode="checkbox"
        responsiveLayout="scroll"
        tableStyle="min-width: 60rem"
        class="rounded-xl border bg-white"
      >
        <!-- bulk checkbox -->
        <Column selectionMode="multiple" headerStyle="width:3rem" bodyStyle="width:3rem" />

        <Column field="id" header="ID" sortable style="width: 6rem">
          <template #body="{ data }"><span class="text-gray-500"> {{ data.id }} </span></template>
        </Column>

        <Column header="Name" field="name" sortable>
          <template #body="{ data }">
            <div class="flex items-center gap-3">
              <!-- ✅ binding correct -->
              <Avatar shape="circle" :image="`https://i.pravatar.cc/40?u=${data.id}`" class="shadow-sm" />
              <div class="min-w-0">
                <div class="truncate font-medium text-gray-900">{{ data.name }}</div>
                <div class="truncate text-xs text-gray-500">{{ handle(data.name) }}</div>
              </div>
            </div>
          </template>
        </Column>

        <Column field="email" header="Email" sortable />

        <Column header="Location">
          <template #body="{ data }">{{ locationOf(data.id) }}</template>
        </Column>

        <Column header="Status">
          <template #body="{ data }">
            <Tag :value="statusOf(data.id)" :severity="statusSeverity(statusOf(data.id))" rounded />
          </template>
        </Column>

        <Column header="Actions" style="width: 5rem; text-align:right">
          <template #body="{ data }">
            <Button icon="pi pi-ellipsis-v" text rounded @click="(e) => openActions(e, data)" />
          </template>
        </Column>
      </DataTable>

      <!-- Popup menu d’actions -->
      <Menu ref="actions" :model="actionItems" popup />
    </div>
  </AppLayout>
</template>

<style scoped>
/* rangées un peu plus compactes */
:deep(.p-datatable .p-datatable-tbody > tr > td) { padding: 0.9rem 1rem; }
:deep(.p-datatable .p-datatable-thead > tr > th) { padding: 0.75rem 1rem; font-weight: 600; }
</style>
