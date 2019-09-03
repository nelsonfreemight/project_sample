<template>
    <div class="login row justify-content-center">
        <div class="col-md-4">
 
            
            <div class="card">
       
                <div class="card-header">register</div>
                <div class="card-body">
                   <form @submit.prevent="add">
                        <div class="form-group row">
                            <label for="name">Name:</label>
                            <input type="text" v-model="form.name" class="form-control" placeholder="Name">
                            <span class="error_span" v-if="errors">
                                <span v-for="(fieldsError, fieldName) in errors" :key="fieldName">
                                    <strong v-if="fieldName==='name'">{{ fieldsError.join() }}</strong>
                                </span>
                            </span>  
                        </div>

                        <div class="form-group row">
                            <label for="email">Email:</label>
                            <input type="text" v-model="form.email" class="form-control" placeholder="Email Address">
                            <span class="error_span" v-if="errors">
                                <span v-for="(fieldsError, fieldName) in errors" :key="fieldName">
                                    <strong v-if="fieldName==='email'">{{ fieldsError.join() }}</strong>
                                    <!-- <strong v-else="fieldName==='ExistEmail'">{{ fieldsError.join() }}</strong> -->
                                </span>
                            </span> 
                            <span class="error_span" v-if="ExistEmail">
                                <strong>{{ ExistEmail }}</strong>      
                            </span>   

                        </div>
                        <div class="form-group row">
                            <label for="password">Password:</label>
                            <input type="password" v-model="form.password" class="form-control" placeholder="Password">
                            <span class="error_span" v-if="errors">
                                <span v-for="(fieldsError, fieldName) in errors" :key="fieldName">
                                    <strong v-if="fieldName==='password'">{{ fieldsError.join() }}</strong>
                                </span>
                            </span>   
                        </div>
                        <div class="form-group row">
                            <label for="password">Password: confirmation</label>
                            <input type="password" v-model="form.password_confirmation" class="form-control" placeholder="password_confirmation">
                            <span class="error_span" v-if="errors">
                                <span v-for="(fieldsError, fieldName) in errors" :key="fieldName">
                                    <strong v-if="fieldName==='password_confirmation'">{{ fieldsError.join() }}</strong>
                                </span>
                            </span>   
                        </div>                       
                        <div class="form-group row">
                            <input type="submit" class ="btn btn-primary" value="Register">
                        </div>
                    </form>
                </div>
         
            </div>
        </div>
    </div>
</template>

<script>
    import validate from 'validate.js';

    export default {
      name: 'register',
 
      data() {
        return {
          form: {
            name: '',
            email: '',
            password: '',
            password_confirmation:'',
          },
          errors: null,
          ExistEmail: null,

        }
      },
      methods: {
            add() {
        
                this.errors = null;
                this.ExistEmail = null;
                
                const constraints = this.getConstraints();
                const errors = validate(this.$data.form, constraints);
        
                if(errors) {
                    this.errors = errors;
                    return;
                }
                
                // new Promise((resolve,reject)=>{
                //     axios.post('/api/auth/register', this.$data.form)
                //         .then((response) => {
                //                 console.log(response);
                //                 resolve(response.data)
                //                 this.$router.push('/login');
                //         },error => {
                //             // reject(error.response.data);
                //             // console.log(error.data);
                //             this.errors = {ExistEmail:'asdasd'};
                //         })
                // });

                  axios.post('/api/auth/register', this.$data.form)
                    .then((response) => {
                            console.log(response.data);
                            this.$store.commit("user", response.data);
                            this.$router.push('/login');
                    }).catch((error) => {
                         this.ExistEmail = "Email already exist!";
                    });;

            },       
            getConstraints() {
              return {
                    name: {
                        presence: true,
                        length: {
                            minimum: 3,
                            message: 'Must be at least 3 characters long'
                        }
                    },
                    email: {
                       presence: true,
                       email: true
                    },
                    password: {
                      presence: true,
                      length: {
                        minimum: 6,
                        message: "must be at least 6 characters long"
                      }
                    },
                    password_confirmation: {
                      presence: true,
                      equality: "password"
                    }
                };
            }
      }
    }
</script>

<style scoped>
.errors {
    background: lightcoral;
    border-radius:5px;
    padding: 21px 0 2px 0;
}

.error_span{
    color: red;
    margin-left: 15px;
}
</style>