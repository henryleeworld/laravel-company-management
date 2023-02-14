<template>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
              <i class="material-icons">assignment</i>
            </div>
            <h4 class="card-title">
              {{ $t('global.table') }}
              <strong>{{ $t('cruds.company.title') }}</strong>
            </h4>
          </div>
          <div class="card-body">
            <router-link
              class="btn btn-primary"
              v-if="$can(xprops.permission_prefix + 'create')"
              :to="{ name: xprops.route + '.create' }"
            >
              <i class="material-icons">
                add
              </i>
              {{ $t('global.add') }}
            </router-link>
            <button
              type="button"
              class="btn btn-default"
              @click="fetchIndexData"
              :disabled="loading"
              :class="{ disabled: loading }"
            >
              <i class="material-icons" :class="{ 'fa-spin': loading }">
                refresh
              </i>
              {{ $t('global.refresh') }}
            </button>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="table-overlay" v-show="loading">
                  <div class="table-overlay-container">
                    <material-spinner></material-spinner>
                    <span>Loading...</span>
                  </div>
                </div>
                <datatable
                  :tblClass="'table'"
                  :columns="columns"
                  :data="data"
                  :total="total"
                  :query="query"
                  :xprops="xprops"
                  :HeaderSettings="false"
                  :pageSizeOptions="[10, 25, 50, 100]"
                >
                  <header-settings :columns="columns" class="pull-right" />
                </datatable>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import DatatableActions from '@components/Datatables/DatatableActions'
import TranslatedHeader from '@components/Datatables/TranslatedHeader'
import HeaderSettings from '@components/Datatables/HeaderSettings'
import DatatableSingle from '@components/Datatables/DatatableSingle'
import DatatableList from '@components/Datatables/DatatableList'
import DatatableCheckbox from '@components/Datatables/DatatableCheckbox'
import DatatableEnum from '@components/Datatables/DatatableEnum'
import DatatablePictures from '@components/Datatables/DatatablePictures'

export default {
  components: {
    HeaderSettings
  },
  data() {
    return {
      columns: [
        { title: 'cruds.company.fields.id', field: 'id', thComp: TranslatedHeader, sortable: true, colStyle: 'width: 50px;' },
        { title: 'cruds.company.fields.name', field: 'name', thComp: TranslatedHeader, sortable: true },
        { title: 'cruds.company.fields.city', field: 'city.name', thComp: TranslatedHeader, tdComp: DatatableSingle },
        {
          title: 'cruds.company.fields.categories',
          field: 'categories.name',
          thComp: TranslatedHeader,
          tdComp: DatatableList
        },
        { title: 'cruds.company.fields.logo', field: 'logo', thComp: TranslatedHeader, tdComp: DatatablePictures },
        {
          title: 'global.actions',
          thComp: TranslatedHeader,
          tdComp: DatatableActions,
          visible: true,
          thClass: 'text-right',
          tdClass: 'text-right td-actions',
          colStyle: 'width: 150px;'
        }
      ],
      query: { sort: 'id', order: 'desc', limit: 100 },
      xprops: {
        module: 'CompaniesIndex',
        route: 'companies',
        permission_prefix: 'company_'
      }
    }
  },
  beforeDestroy() {
    this.resetState()
  },
  computed: {
    ...mapGetters('CompaniesIndex', ['data', 'total', 'loading'])
  },
  watch: {
    query: {
      handler(query) {
        query.page = (query.offset + query.limit) / query.limit
        this.setQuery(query)
        this.fetchIndexData()
      },
      deep: true
    }
  },
  methods: {
    ...mapActions('CompaniesIndex', [
      'fetchIndexData',
      'setQuery',
      'resetState'
    ])
  }
}
</script>
