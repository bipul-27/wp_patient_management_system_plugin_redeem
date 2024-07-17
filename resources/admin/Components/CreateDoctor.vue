<template>
    <div class="create-doctor-container">
        <el-button type="primary" @click="navigateBack">Back to Doctor List</el-button>
        <el-card class="create-doctor-card" shadow="hover">
            <h2>{{ isEdit ? 'Edit Doctor' : 'Create Doctor' }}</h2>
            <el-form :model="doctors" label-width="120px" class="create-doctor-form">
                <el-form-item label="Username">
                    <el-input v-model="doctors.username"></el-input>
                </el-form-item>
                <el-form-item label="Password" v-if="isEdit">
                    <el-input type="password" v-model="doctors.password"></el-input>
                </el-form-item>
                <el-form-item label="Email">
                    <el-input v-model="doctors.email"></el-input>
                </el-form-item>
                <el-form-item label="Name">
                    <el-input v-model="doctors.name"></el-input>
                </el-form-item>
                <el-form-item label="Speciality">
                    <el-input v-model="doctors.speciality"></el-input>
                </el-form-item>
                <el-form-item label="Contact Info">
                    <el-input v-model="doctors.contact_info"></el-input>
                </el-form-item>
                <el-form-item class="form-actions">
                    <el-button type="primary" @click="saveDoctor">{{ isEdit ? 'Update' : 'Create' }}</el-button>
                    <el-button @click="navigateBack">Cancel</el-button>
                </el-form-item>
            </el-form>
        </el-card>
    </div>
</template>

<script>
export default {
    name: 'CreateDoctor',
    data() {
        return {
            doctors: {
                username: '',
                password: '',
                email: '',
                name: '',
                speciality: '',
                contact_info: ''
            },
            saving: false
        };
    },
    methods: {
        navigateBack() {
            this.$router.push({ name: 'dashboard' });
        },
        fetchDoctors(id) {
            this.saving = true;
            this.$get('doctors/${id}')
            .then(response => {
                Object.assign(this.doctorForm, response);

            })
            .catch(errors => {
                    this.$handleError(errors);
                    console.log(errors);
                })
             .finally(() => {
                 this.saving = false;
            });
            
        },
        saveDoctor(){
            if(this.isEdit)
        {
            this.$put('doctors/${id}',{
                doctors:this.doctors,
            })
            .then(response=>{
                this.$notify.success(response.message || 'Doctor Edited successfully');
                this.navigateBack();
            })
        }
        else{
            this.$post('doctors',{
                doctors: this.doctors,
            })
            .then(response => {
                this.$notify.success(response.message || 'Doctor Created successfully');
            })
            .catch(errors => {
                    this.$handleError(errors);
                    console.log(errors);
                })
             .finally(() => {
                 this.saving = false;
            });
            this.navigateBack();
            
        }
        },
        // createDoctor() {
        //     // Mocked create doctor function, replace with actual API call
        //     // console.log('Creating doctor with data:', this.doctors);
        //     this.$post('doctors',{
        //         doctors: this.doctors,
        //     })
        //     .then(response => {

        //     })
        //     .catch(errors => {
        //             this.$handleError(errors);
        //             console.log(errors);
        //         })
        //      .finally(() => {
        //          this.saving = false;
        //     });
        //     this.navigateBack();
        // },
        
    },
    mounted()
    {
        const doctorId = this.$route.params.id;
        if(doctorId)
    {
        this.isEdit = true;
        this.doctorId=doctorId;
        this.fetchDoctors(doctorId);
    }
    }
}
</script>

<style scoped>
.create-doctor-container {
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.create-doctor-card {
    width: 100%;
    max-width: 600px;
    margin-top: 20px;
}

.create-doctor-form {
    width: 100%;
}

.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}
</style>
