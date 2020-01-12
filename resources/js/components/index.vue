<template>
        <section class="wrapper">
            <!--state overview start-->
            <div class="row state-overview">
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol terques">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="value">
                            <h1 class="count">
                                {{usercount}}
                            </h1>
                            <p>Nhân viên</p>
                        </div>
                    </section>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol red">
                            <i class="fa fa-tags"></i>
                        </div>
                        <div class="value">
                            <h1 class=" count2">
                                {{productstock}}
                            </h1>
                            <p>Tồn kho</p>
                        </div>
                    </section>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol yellow">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div class="value">
                            <h1 >
                                <h1 class="count">
                                {{inputcount}}
                            </h1>
                            </h1>

                            <p>Đơn nhập kho</p>
                        </div>
                    </section>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <section class="panel">
                        <div class="symbol blue">
                            <i class="fa fa-bar-chart-o"></i>
                        </div>
                        <div class="value">
                            <h1 class=" count4">
                                {{outputcount}}
                            </h1>
                            <p>Số lượng đơn xuất kho</p>
                        </div>
                    </section>
                </div>
            </div>
        
            <!--state overview end-->
            <div>
                <full-calendar :events="events"></full-calendar>

            </div>
        </section>
</template>

<script>
    import { Line } from 'vue-chartjs';
import { type } from 'os';
    export default {
        name: "index.vue",
        props: {
                usercount: {type: Number},
                inputcount: {type: Number, required: true},
                outputcount: {type: Number, required: true},
                productstock: {type: Number,required: true},
        },
        methods: {
           data() {
                return {
                    events: 
                    {
                        title : 'Sự kiện 1',
                        start : '2020-02-16',
                    }    
                }
                },
        }
    }
</script>

<style scoped>
</style>
