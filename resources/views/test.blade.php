<template>
    <div class="row menu-detail">
        <div class="col-md-12">
            <h2 class="label-size-33" >メニュー変更　＞　新規レストランを作成する</h2>
            <div class="card padding-lr-30">
                <form class="card-body" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 content-form">
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="label-size-22 text-bold md-pl-100">メニュー情報</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="col-md-11 offset-1 clearfix">
                                                <div class="form-group-cs d-flex">
                                                    <div class="col-md-2"><label for="menu-name" class="label-size-20">料理名</label></div>
                                                    <div class="col-md-8">
                                                        <input type="text" id="menu-name" class="form-control label-size-19"
                                                               name="name" value="" v-model="menus.name">
                                                    </div>
                                                </div>
                                                <p class="errMessage" v-if="errors.name">{{ errors.name[0].replace('name', '料理名') }}</p>
                                            </div>
                                            <div class="col-md-11 offset-1 clearfix">
                                                <div class="form-group-cs d-flex">
                                                    <div class="col-md-2"><label for="menu-name" class="label-size-20">英</label></div>
                                                    <div class="col-md-8">
                                                        <input type="text" id="menu-name-en" class="form-control label-size-19"
                                                               name="name_english" value="" v-model="menus.name_english">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-11 offset-1 clearfix">
                                                <div class="form-group-cs d-flex">
                                                    <div class="col-md-2"><label for="menu-name" class="label-size-20">中</label></div>
                                                    <div class="col-md-8">
                                                        <input type="text" id="menu-name-cn" class="form-control label-size-19"
                                                               name="name_chinese" value="" v-model="menus.name_chinese">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-11 offset-1 clearfix">
                                                <div class="form-group-cs d-flex">
                                                    <div class="col-md-2"><label for="menu-name" class="label-size-20">ジャンル</label></div>
                                                    <div class="col-md-8">
                                                        <select class="form-control label-size-22 cs-select-form"
                                                                name="type" v-model="menus.type">
                                                            <option value="food">フード</option>
                                                            <option value="drink">ドリンク</option>
                                                            <option value="set">セット</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-11 offset-1 clearfix">
                                                <div class="form-group-cs d-flex">
                                                    <div class="col-md-2"><label for="order" class="label-size-20">設定</label></div>
                                                    <div class="col-md-8">
                                                        <select class="form-control label-size-22 cs-select-form"
                                                                name="status" v-model="menus.status" id="order">
                                                            <option value="public">公開中</option>
                                                            <option value="unpublic">非公開</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <p class="errMessage" v-if="errors.status">{{errors.status[0].replace('status', '設定') }}</p>
                                            </div>
                                            <div class="col-md-11 offset-1 clearfix">
                                                <div class="form-group-cs d-flex">
                                                    <div class="col-md-2"><label for="non-taxed-price" class="label-size-20">税抜き価格</label></div>
                                                    <div class="col-md-8 input-group">
                                                        <input type="text" id="non-taxed-price" class="form-control label-size-19"
                                                               name="price" v-model="menus.price">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">円</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="errMessage" v-if="errors.price">{{errors.price[0].replace('price', '税抜き価格') }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="md-space-height-56"></div>
                                            <div class="feature-image-menu">
                                                <input type="file" name="photo" v-on:change="handleSelectFile" class="mouse" ref="file">
                                                <img src="/assets/img/icons/add.svg" alt="Update Feature Image"
                                                     class="icon-svg icon-add">
                                                <span class="label-size-33 photo-name">写真</span>
                                                <img v-if="menus.image" :src="menus.image.url" class="photo-menu" :class="{preview: false}">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Begin: Raw Materials -->
                                    <div class="md-space-height-86"></div>
                                    <div class="row clearfix">
                                        <div class="col-md-2">
                                            <div class="label-size-22 md-pl-32 text-bold">材料一覧</div>
                                        </div>
                                        <div class="col-md-9 label-size-16 text-danger">
                                            <div class="text-danger text-bold clearfix">
                                                ※特定原材料7品目は赤、特定原材料に準ずるもの20品目は黄色で表示されます。
                                            </div>
                                            <div class="text-danger text-bold">
                                                ※材料のグラム数は栄養士の計算のために使用し、ユーザーには表示されません。
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-10 offset-1 d-inline-flex clearfix">
                                            <div class="col label-size-19 ">
                                                <div class="row clearfix" >
                                                    <div class="col-md-3 input-text pl-3">
                                                        <div class="form-group text-center">
                                                            材料名
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 input-text pr-3">
                                                        <div class="form-group text-center">
                                                            分量
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 input-text pr-3">
                                                        <div class="form-group text-center">
                                                            英語名
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 input-text pr-3">
                                                        <div class="form-group text-center">
                                                            中国語名
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row clearfix line-height" v-for="(i, index) in material">
                                                    <div class="col-md-3 input-text pl-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                   name="material_name[]"
                                                                   v-model="material.name = i.name">
                                                        </div>
                                                        <span class="error-message-in-array"
                                                              v-if="errors.hasOwnProperty(`material_name.`+index)">
                                                            {{getMapError(errors, `material_name.`+index)}}
                                                        </span>
                                                    </div>
                                                    <div class="col-md-2 input-text pr-3 ">
                                                        <div class="form-group input-group">
                                                            <input type="number" class="form-control"
                                                                   name="material_value[]"
                                                                   v-model="material.value = i.value">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">g</span>
                                                            </div>
                                                        </div>
                                                        <span class="error-message-in-array"
                                                              v-if="errors.hasOwnProperty(`material_value.`+index)">
                                                            {{getMapError(errors, `material_value.`+index)}}
                                                        </span>
                                                    </div>
                                                    <div class="col-md-3 input-text pr-3 ">
                                                        <div class="form-group input-group">
                                                            <input type="text" class="form-control"
                                                                   name="material_name_english"
                                                                   v-model="material.name_english = i.name_english">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 input-text pr-3 ">
                                                        <div class="form-group input-group">
                                                            <input type="text" class="form-control"
                                                                   name="material_name_chinese"
                                                                   v-model="material.name_chinese = i.name_chinese">
                                                        </div>
                                                    </div>
                                                    <div col-md-1>
                                                        <div class="remove-input"
                                                             v-on:click="removeMaterial(index)">×
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="material-name">
                                                    <div class="col-md-3">
                                                        <div class="btn btn-dark btn-fill col-md-12 max-width-input"
                                                             v-on:click="addMaterial">
                                                            <img src="/assets/img/icons/add-circle.svg"
                                                                 alt="" class="icon add-icon">
                                                            <span class="button-name label-size-19">欄を追加して入力</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End: Raw Materials -->
                                    <!-- Begin: Raw Materials -->
                                    <div class="md-space-height-56"></div>
                                    <div class="row clearfix" >
                                        <div class="col-md-2">
                                            <div class="label-size-22 text-bold md-pl-32">料理名と調理法</div>
                                        </div>
                                        <div class="col-md-9 label-size-16 text-danger">
                                            <div class="text-danger text-bold clearfix">
                                                ※栄養計算に使用しますので大まかな記述でかまいません。
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row label-size-19" id="cooking-name">
                                        <div class="col-md-10 offset-1 d-inline-flex clearfix">
                                            <div class="col-md-12">
                                                <div class="row clearfix">
                                                    <div class="col-md-3 input-text pl-3">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="cooking_name"
                                                                   v-model="menus.cooking_name">
                                                        </div>
                                                        <p class="error-message" v-if="errors.cooking_name">
                                                            {{errors.cooking_name[0].replace('cooking name', '料理')}}
                                                        </p><br>
                                                    </div>
                                                    <div class="col-md-3 input-text">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control"
                                                                   name="cooking_method" v-model="menus.cooking_method">
                                                        </div>
                                                        <p class="error-message" v-if="errors.cooking_method">
                                                            {{errors.cooking_method[0].replace('cooking method', '料理') }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <!-- Begin: Add button Materials -->
                                                <div class="row clearfix" hidden>
                                                    <div class="col-md-6 input-text pl-3"></div>
                                                    <div class="col-md-6">
                                                        <div class="btn btn-dark btn-fill col-md-12 max-width-input"
                                                             disabled>
                                                            <img src="/assets/img/icons/add-circle.svg"
                                                                 alt="" class="icon add-icon">
                                                            <span class="button-name label-size-19">欄を追加して入力</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End: Add button Materials -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End: Raw Materials -->
                                    <!-- Begin: Raw Materials Display web -->
                                    <div class="md-space-height-56"></div>
                                    <div class="row clearfix">
                                        <div class="col-md-3">
                                            <div class="label-size-22 text-bold md-pl-32">成分一覧</div>
                                        </div>

                                        <div class="col-md-10 offset-1 d-inline-flex clearfix">
                                            <div class="col-md-6 label-size-19 ">
                                                <div class="row clearfix" >
                                                    <div class="col-md-6 input-text pl-3">
                                                        <div class="form-group text-center">
                                                            材料名
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 input-text pr-3">
                                                        <div class="form-group text-center">
                                                            分量
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-6 input-text float-left">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" value="エネルギー" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 input-text float-right">
                                                        <div class="form-group input-group">
                                                            <input type="number" name="nutritional" class="form-control"
                                                                   v-model="menus.nutritional_energy" disabled>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">kcal</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-6 input-text float-left">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" value="たんぱく質" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 input-text float-right">
                                                        <div class="form-group input-group">
                                                            <input type="number" name="nutritional" class="form-control"
                                                                   v-model="menus.nutritional_protein" disabled>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">g</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-6 input-text float-left">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" value="脂質" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 input-text float-right">
                                                        <div class="form-group input-group">
                                                            <input type="number" name="nutritional" class="form-control"
                                                                   v-model="menus.nutritional_lipid" disabled>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">g</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-6 input-text float-left">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" value="炭水化物" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 input-text float-right">
                                                        <div class="form-group input-group">
                                                            <input type="number" name="nutritional" class="form-control"
                                                                   v-model="menus.nutritional_carbohydrate" disabled>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">g</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="col-md-6 input-text float-left">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" value="食塩相当量" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 input-text float-right">
                                                        <div class="form-group input-group">
                                                            <input type="number" name="nutritional" class="form-control"
                                                                   v-model="menus.nutritional_salt" disabled>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">g</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center clearfix">
                            <a href="/admin/menus" onchange="null"
                               class="btn btn-primary btn-fill padding-lr-30 mr-3 label-size-15 col-md-2">戻る</a>
                            <button type="submit"
                                    class="btn btn-primary btn-fill padding-lr-30 ml-3 label-size-15 cursor-point col-md-2"
                                    @click.prevent="postData()">保存
                            </button>
                        </div>
                        <div class="col-md-12 text-center clearfix">
                            <div class="label-size-17">
                                ※成分表の変更には少々お時間がかかります。更新ができましたら、ホームの「お知らせ」にてご連絡いたします。
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: 'create-menu',
        props: {
            parent_name: {type: String, required: true, default: 'name'},
            parent_id: {type: Number, required: true, default: 0},
        },
        data() {
            return {
                menus: {
                    type: 'food',
                    name: '',
                    name_english: '',
                    name_chinese: '',
                    status: 'public',
                    price: '',
                    cooking_name: '',
                    cooking_method: '',
                    nutritional_energy: 0,
                    nutritional_protein: 0,
                    nutritional_lipid: 0,
                    nutritional_carbohydrate: 0,
                    nutritional_salt: 0,
                    photo: '',
                },
                material: [{name: '', value: '', name_english: '', name_chinese: ''}],
                isActive: true,
                file: '',
                errors: [],
            }
        },
        methods: {
            postData() {
                /**
                 * Create a new formData
                 * */
                let formData = new FormData();
                formData.append('name', this.menus.name);
                formData.append('name_english', this.menus.name_english);
                formData.append('name_chinese', this.menus.name_chinese);
                formData.append('type', this.menus.type);
                formData.append('status', this.menus.status);
                formData.append('price', this.menus.price);
                formData.append('cooking_name', this.menus.cooking_name);
                formData.append('cooking_method', this.menus.cooking_method);
                formData.append('nutritional_energy', this.menus.nutritional_energy);
                formData.append('nutritional_protein', this.menus.nutritional_protein);
                formData.append('nutritional_lipid', this.menus.nutritional_lipid);
                formData.append('nutritional_carbohydrate', this.menus.nutritional_carbohydrate);
                formData.append('nutritional_salt', this.menus.nutritional_salt);
                formData.append('photo', this.file);

                for (let i = 0; i < this.material.length; i++) {
                    formData.append('material_name[]', this.material[i].name);
                    formData.append('material_value[]', this.material[i].value);
                    formData.append('material_name_english[]', this.material[i].name_english);
                    formData.append('material_name_chinese[]', this.material[i].name_chinese);
                }
                axios({
                    method: 'post',
                    url: '/' + this.parent_name + '/' + this.parent_id + '/menu/store',
                    data: formData,
                    config: {headers: {'Content-Type': 'multipart/form-data'}}
                })
                    .then(res => {
                        localStorage.setItem(res.data.message.status, res.data.message.content);
                        window.location.href = res.data.url;
                    })
                    .catch(err => {
                        this.errors = err.response.data.errors;
                        if (this.errors.name || this.errors.price) {
                            $("label[for='menu-name']").get(0).scrollIntoView(false);
                        } else if (this.errors.cooking_name || this.errors.cooking_method) {
                            $("#material-name").get(0).scrollIntoView();
                        }
                    });
            },
            /**
             * Get error
             *
             * @return {string} error
             * */
            getMapError(obj, key) {
                if (key.includes('material'))
                    $("#non-taxed-price").get(0).scrollIntoView();

                if (obj.hasOwnProperty(key))
                    return obj[key][0].replace(key, 'このフィールド');
                throw new Error("Invalid map key.");
            },
            /**
             * Add element input of the material
             * */
            addMaterial() {
                this.material.push({name: '', value: '', name_english: '', name_chinese: ''});
            },
            /**
             * Remove element input of the material
             * @param {number} index - Ordinal number element input of the material
             * */
            removeMaterial(index) {
                this.material.splice(index, 1);
            },
            /**
             * Get the image file
             * @param {event} event The react `SyntheticEvent`
             * */
            handleSelectFile(event) {
                this.menus.photo = event.target.files[0];
                this.file = this.$refs.file.files[0];
                let reader = new FileReader();
                reader.readAsDataURL(this.menus.photo);
                reader.onload = event => {
                    this.menus.photo = event.target.result;
                };
                this.isActive = false;
            },
        }
    }
</script>

<style lang="scss" scoped>
    .card-body {
        padding: 0;
    }
    .form-group {
        margin-bottom: 2px !important;
    }
    .remove {
        float: left;
    }

    .line-height {
        max-height: 70px;
    }

    .remove-input {
        content: 'x';
        text-align: center;
        cursor: pointer;
        padding-top: 7px;
        color: red;
        font-weight: bolder;
    }

    .mouse {
        cursor: pointer;
    }

    .preview {
        display: none;
    }

    .errMessage {
        color: red;
        font-size: 18px;
        font-weight: 500;
        float: left;
        margin-bottom: 10px;
        margin-left: 18%;
    }

    .error-message{
        color: red;
        font-size: 18px;
        font-weight: 500;
        margin-bottom: 10px;
        float: left;
    }

    span.error-message-in-array {
        color: red;
        font-size: 13px !important;
        font-weight: 500;
        float:left;
        margin-left:3%;
    }

    .errMessage2 {
        border: 1px solid red;
    }
    .max-width-input {
        width: 98%;
    }
    .col-md-12.text-center.clearfix {
        padding: 4em;
    }
</style>
