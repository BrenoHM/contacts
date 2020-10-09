<template>
    <el-row v-loading.fullscreen.lock="fullscreenLoading" :gutter="20">
        <el-col :gutter="20" style="padding-bottom: 10px">
            <el-button @click="alterarRota('ContactRegistration')" type="primary">New Record</el-button>
        </el-col>
        <el-col :gutter="20">
            <el-table
                v-if="contacts"
                :data="contacts.filter(data => !search || 
                (data.name.toLowerCase().includes(search.toLowerCase()) || 
                data.email.toLowerCase().includes(search.toLowerCase()) ||
                data.phone.toLowerCase().includes(search.toLowerCase())
                ))"
                style="width: 100%">
                <el-table-column
                        header-align="center"
                        align=""
                        label="Name"
                        >
                    <template slot-scope="scope">
                        <span style="margin-left: 10px">{{ scope.row.name }}</span>
                    </template>
                </el-table-column>
                <el-table-column
                        header-align="center"
                        align="center"
                        label="Email">
                    <template slot-scope="scope">
                        <span style="margin-left: 10px">{{ scope.row.email }}</span>
                    </template>
                </el-table-column>
                <el-table-column
                        header-align="center"
                        align="center"
                        label="Phone">
                    <template slot-scope="scope">
                        <span style="margin-left: 10px">{{ scope.row.phone }}</span>
                    </template>
                </el-table-column>
                <el-table-column
                        header-align="center"
                        align="center"
                        label="Status">
                    <template slot-scope="scope">
                        <el-button
                                size="mini"
                                @click="handleEdit(scope.$index, scope.row)">Edit
                        </el-button>

                        <el-popconfirm
                                confirmButtonText='OK'
                                cancelButtonText='No, Thanks'
                                icon="el-icon-info"
                                iconColor="red"
                                title="Are you sure to delete this?"
                                @onConfirm="handleDelete(scope.$index, scope.row)"
                        >
                            <el-button
                                    size="mini"
                                    type="danger"
                                    slot="reference"
                            >Delete
                            </el-button>
                        </el-popconfirm>
                    </template>
                    <template slot="header" slot-scope="scope">
                        <el-input v-model="search" placeholder="Search for name, email or phone"></el-input>
                    </template>
                </el-table-column>
            </el-table>
        </el-col>
        <el-col :span="20">
            <el-pagination
                class="pagination"
                @current-change="getList()"
                background
                small
                layout="total, prev, pager, next"
                :page-size="filter.pagination.per_page"
                :current-page.sync="filter.pagination.current_page"
                :total="filter.pagination.total">
            </el-pagination>
        </el-col>
    </el-row>
</template>
<script>
import Contact from '../../requests/Contact';
import Pagination from "../../models/Pagination";

export default {
    name: "ContactLista",
    data() {
        return {
            fullscreenLoading: true,
            filter: {
                pagination: new Pagination(),
                data: {},
            },
            contacts: null,
            search: '',
        }
    },
    methods: {
        alterarRota(rota) {
            this.$router.push({name: rota});
        },
        handleEdit(index, row) {
            this.$router.push({name: 'ContactRegistration', query: {id: row.id}})
        },
        handleDelete(index, row) {
            this.fullscreenLoading = true;
            Contact.remove(row).then(response => {
                if (response.data) {
                    this.$notify({
                        title: 'Contact',
                        message: 'Successfully deleted',
                        type: 'success'
                    });
                }
                this.getList();
            }).catch(error => {
                this.fullscreenLoading = false;
                this.$notify.error({
                    title: 'Contact',
                    message: error.response.data.message,
                });
            })
        },
        getList() {
            this.fullscreenLoading = true;
            Contact.list(this.filter).then(response => {
                this.contacts = response.data.data;
                this.filter.pagination = new Pagination(response.data)
                this.fullscreenLoading = false;
            }).catch(error => {
                this.fullscreenLoading = false;
                this.$notify.error({
                    title: 'Contact',
                    message: error.response.data.message,
                });
            })
        }
    },
    mounted() {
        this.getList();
    }
}
</script>