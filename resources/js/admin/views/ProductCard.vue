<template>
    <div class="admin-product-card">
        <div class="admin-product-card-header">
            <div class="wrap-card-header">
                <h1 class="admin-h1">Карточка товара</h1>
                <span class="card-name">{{this.nameProduct}}</span>
            </div>
            <button class="admin-btn-complete width-300" @click="sentProductData()">Сохранить изменения</button>
        </div>
        <div class="admin-product-card-desc">
            <div class="wrap-card-desc">
                <h1 class="admin-h3">Описание товара</h1>
                <textarea placeholder="Введите текст" @change="changeTextProduct" v-model.trim="textProduct" class="input-transp"></textarea>
            </div>
            <div class="wrap-card-price">
                <h1 class="admin-h3">Цена</h1>
                <input type="text" class="input-transp" @change="changePriceProduct" v-model.trim="priceProduct">
                <h1 class="admin-h3">Цена со скидкой</h1>
                <input type="text" class="input-transp" @change="changeSaleProduct" v-model.trim="saleProduct">
            </div>
            <div class="wrap-card-sizes">
                <div class="wrap-newsize">
                    <h1 class="admin-h3">Доступные размеры</h1>
                    <div class="wrapper-newsize-add">
                        <div class="wrap-newsize-add">
                            <input type="text" placeholder="Новый размер" class="input-transp" v-model="chozenSizeAfterClick" disabled>
                            <button class="btn-admin-arrow" @click="activeBtnSize = !activeBtnSize" v-bind:class="activeBtnSize ? 'admin-btn-arrow' : 'admin-btn-arrow-pass'"></button>
<!--                            <button @click="addSize" class="btn-admin-purpp"><img src="../../../img/whiteplus.png" alt=""></button>-->
                        </div>
                        <AdminCrumbs v-if="activeBtnSize" v-bind:sizes="getAllSizes" @addNewSize="addNewSize"/>
                    </div>
                    <div class="wrap-newsize-stock">
                        <h1 class="admin-h3">Кол-во на складе</h1>
                        <input type="text" class="input-transp" @change="insertAmountStock" v-if="!timeToChangePresetnSizes" v-model.trim="chozenSizeStockAfterClick">
                        <input type="text" class="input-transp" @change="insertAmountStockUpdate" v-if="timeToChangePresetnSizes" v-model.trim="chozenSizeStockAfterClick">
                    </div>
                </div>
                <div class="size-grid">
                    <h1 class="admin-h3">Добавленные размеры</h1>
                    <div class="wrap-size-grid">
                        <span v-for="(sz, i) in presentSizes" @click="selectSizeForStockUpdate(sz.catalog_size_amount, sz.sizes_number, i)">
                            {{sz.sizes_number}}
                        </span>
                        <span v-for="(sz, i) in sizes" @click="selectSizeForStock(i)" @dblclick="deleteSize(i)">
                        {{sz.size}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="admin-product-photos-rew">
            <div class="admin-photos">
                <form @submit.prevent="">
                    <h1 class="admin-h3">Фотографии</h1>
                    <div class="uploaded-content">
                        <svg id='video-admin' v-if="video" class="fill-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 413.19 358.83"><defs></defs><title>icon_cam</title><path d="M150.57,419.73c-3.12-1-6.25-1.89-9.34-3-3.87-1.33-6.63-4.17-9.34-7.09-4.86-5.24-6.47-11.5-6.46-18.46q.06-70.32,0-140.62c0-4.32.41-8.59,2.45-12.41,5.18-9.66,13.3-15,24.31-15.77,1-.07,2.09-.06,3.14-.06q120.42,0,240.86,0c8.7,0,16.39,2.5,22.32,9a27.17,27.17,0,0,1,7.52,19q-.18,70.64,0,141.28c0,9-3.62,16-10.16,21.68a26.11,26.11,0,0,1-13.09,5.91c-.65.11-1.28.32-1.92.48ZM275.7,240.31H156c-1,0-1.95,0-2.91.06-4.58.41-7.78,3.09-8.57,7.21a16.35,16.35,0,0,0-.18,3.13v140.6c0,.75,0,1.5.05,2.24a8.54,8.54,0,0,0,6.3,7.6,20.32,20.32,0,0,0,4.85.6q120.2,0,240.39,0a16.78,16.78,0,0,0,2.46-.06c5.29-.82,8.89-3.87,8.79-9.45,0-.45,0-.9,0-1.35V251.23a20.06,20.06,0,0,0-.06-2.69c-.37-2.69-1.29-5.2-4-6.27-2.23-.88-4.63-1.87-7-1.87Q335.9,240.22,275.7,240.31Z" transform="translate(-125.43 -60.9)"/><path d="M348.48,204.43a75.79,75.79,0,0,1-34.64-9.33,77.74,77.74,0,0,1-21.13-17,70,70,0,0,1-9.82-15.1c-9.5-18.84-9.44-38.09-1.74-57.33a73.3,73.3,0,0,1,9.92-16.59,67.26,67.26,0,0,1,19.16-16.89A77.07,77.07,0,0,1,360.5,61.53a75.13,75.13,0,0,1,31.73,11.39A77.89,77.89,0,0,1,411.68,90.8c5.58,7.14,8.86,15.22,11.6,23.71a60.46,60.46,0,0,1,1,32.87c-2,8.29-4.94,16.42-9.9,23.54a76.25,76.25,0,0,1-20,20.19C381.23,199.91,366.67,204.4,348.48,204.43ZM350,78.78c-1.42.12-3.66.23-5.88.49-18.9,2.21-33.8,11.42-42.91,27.87-9.84,17.76-9.56,36.11,1.74,53.65A51.35,51.35,0,0,0,313.63,173a55.25,55.25,0,0,0,20.12,10.86c23.47,6.51,43.63.69,60.35-16.81a46.9,46.9,0,0,0,10.64-18.93c3.67-12,3.37-24-1.93-35.74a55.26,55.26,0,0,0-20.63-24.31C372.64,81.87,362.16,79,350,78.78Z" transform="translate(-125.43 -60.9)"/><path d="M519.61,378.07V264c-2.23,1-4.39,1.88-6.5,2.89q-18.74,9-37.46,18-8.56,4.11-17.17,8.13c-5.37,2.5-11.13.38-13.06-4.73a8.79,8.79,0,0,1,4.45-11.17c4.36-2.28,8.83-4.34,13.28-6.45,4.17-2,8.38-3.85,12.54-5.84,9.07-4.36,18.12-8.77,27.18-13.14,7-3.37,14-6.66,21-10.05a10.6,10.6,0,0,1,11.42.75,8.11,8.11,0,0,1,3.24,5.92,15,15,0,0,1,.06,2c0,47.16-.06,94.32.06,141.47,0,6.8-5.27,10.22-10.16,9.87a15.4,15.4,0,0,1-5.28-1.66c-12.58-6-25.12-12.07-37.68-18.1q-14.81-7.11-29.64-14.17c-2-1-4.11-1.78-6.06-2.84-4.47-2.45-6.12-7.21-4.15-11.64a9.09,9.09,0,0,1,11.67-4.71c2.78,1.07,5.44,2.44,8.13,3.73,9.2,4.42,18.38,8.9,27.59,13.31,8.46,4.05,17,8,25.45,12.05C518.79,377.82,519.13,377.9,519.61,378.07Z" transform="translate(-125.43 -60.9)"/><path d="M197.8,204.41a56.66,56.66,0,0,1-25.88-7.55,55.07,55.07,0,0,1-21-21.11c-8.8-15.66-8.81-31.7-1.56-47.65a50.48,50.48,0,0,1,20.19-22.45c15.86-9.55,32.69-11.52,50.32-5.55a56.5,56.5,0,0,1,20.6,12.65,53.65,53.65,0,0,1,10.22,13.72c8.3,15,8.14,30.5,1.47,45.83a51.91,51.91,0,0,1-19.83,22.77C222.67,201.34,212,204.51,197.8,204.41Zm4.13-89.7c-14.11.19-24.54,5.26-32.13,15.26-10.06,13.24-8.08,32.56,1.68,43.25,6.85,7.49,15,12,25,13,15.15,1.46,27.42-4.2,36-16.64,8.35-12.05,6.92-30.12-2.1-40.68C222.38,119.51,212.47,115.18,201.93,114.71Z" transform="translate(-125.43 -60.9)"/><path transform="translate(-125.43 -60.9)"/></svg>
                        <video :src="video" v-if="video !== null" @click="clickVideo"></video>
                        <img v-for="(img, i) in files" v-bind:ref="'image' + parseInt(i)" v-bind:class="img.active ? 'puprr-border' : 'unctive-blu-img'" @click="clickImg(i)">
                    </div>
                    <div class="wrap-load">
                        <label for="loadImg" class="admin-btn-add">Добавить изображение <img src="../../../img/purpp-krest.png" alt=""></label>
                    </div>
                    <div class="wrap-load">
                        <label for="loadVid" class="admin-btn-add">Добавить видео <img src="../../../img/purpp-krest.png" alt=""></label>
                    </div>
                    <button class="admin-btn-complete">выбрать обложкой</button>
                    <input type="file" value="Добавить изображение" id="loadImg" ref="img" @change="pushImg()" multiple accept="image/jpeg,image/png">
                    <input type="file" value="Добавить видео" id="loadVid" ref="vid" @change="loadVid()" accept="video/*">
                </form>
                <div class="admin-main-photo" v-if="mainImg || video">
                    <svg v-if="videoOrImg" class="fill-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 413.19 358.83"><defs></defs><title>icon_cam</title><path d="M150.57,419.73c-3.12-1-6.25-1.89-9.34-3-3.87-1.33-6.63-4.17-9.34-7.09-4.86-5.24-6.47-11.5-6.46-18.46q.06-70.32,0-140.62c0-4.32.41-8.59,2.45-12.41,5.18-9.66,13.3-15,24.31-15.77,1-.07,2.09-.06,3.14-.06q120.42,0,240.86,0c8.7,0,16.39,2.5,22.32,9a27.17,27.17,0,0,1,7.52,19q-.18,70.64,0,141.28c0,9-3.62,16-10.16,21.68a26.11,26.11,0,0,1-13.09,5.91c-.65.11-1.28.32-1.92.48ZM275.7,240.31H156c-1,0-1.95,0-2.91.06-4.58.41-7.78,3.09-8.57,7.21a16.35,16.35,0,0,0-.18,3.13v140.6c0,.75,0,1.5.05,2.24a8.54,8.54,0,0,0,6.3,7.6,20.32,20.32,0,0,0,4.85.6q120.2,0,240.39,0a16.78,16.78,0,0,0,2.46-.06c5.29-.82,8.89-3.87,8.79-9.45,0-.45,0-.9,0-1.35V251.23a20.06,20.06,0,0,0-.06-2.69c-.37-2.69-1.29-5.2-4-6.27-2.23-.88-4.63-1.87-7-1.87Q335.9,240.22,275.7,240.31Z" transform="translate(-125.43 -60.9)"/><path d="M348.48,204.43a75.79,75.79,0,0,1-34.64-9.33,77.74,77.74,0,0,1-21.13-17,70,70,0,0,1-9.82-15.1c-9.5-18.84-9.44-38.09-1.74-57.33a73.3,73.3,0,0,1,9.92-16.59,67.26,67.26,0,0,1,19.16-16.89A77.07,77.07,0,0,1,360.5,61.53a75.13,75.13,0,0,1,31.73,11.39A77.89,77.89,0,0,1,411.68,90.8c5.58,7.14,8.86,15.22,11.6,23.71a60.46,60.46,0,0,1,1,32.87c-2,8.29-4.94,16.42-9.9,23.54a76.25,76.25,0,0,1-20,20.19C381.23,199.91,366.67,204.4,348.48,204.43ZM350,78.78c-1.42.12-3.66.23-5.88.49-18.9,2.21-33.8,11.42-42.91,27.87-9.84,17.76-9.56,36.11,1.74,53.65A51.35,51.35,0,0,0,313.63,173a55.25,55.25,0,0,0,20.12,10.86c23.47,6.51,43.63.69,60.35-16.81a46.9,46.9,0,0,0,10.64-18.93c3.67-12,3.37-24-1.93-35.74a55.26,55.26,0,0,0-20.63-24.31C372.64,81.87,362.16,79,350,78.78Z" transform="translate(-125.43 -60.9)"/><path d="M519.61,378.07V264c-2.23,1-4.39,1.88-6.5,2.89q-18.74,9-37.46,18-8.56,4.11-17.17,8.13c-5.37,2.5-11.13.38-13.06-4.73a8.79,8.79,0,0,1,4.45-11.17c4.36-2.28,8.83-4.34,13.28-6.45,4.17-2,8.38-3.85,12.54-5.84,9.07-4.36,18.12-8.77,27.18-13.14,7-3.37,14-6.66,21-10.05a10.6,10.6,0,0,1,11.42.75,8.11,8.11,0,0,1,3.24,5.92,15,15,0,0,1,.06,2c0,47.16-.06,94.32.06,141.47,0,6.8-5.27,10.22-10.16,9.87a15.4,15.4,0,0,1-5.28-1.66c-12.58-6-25.12-12.07-37.68-18.1q-14.81-7.11-29.64-14.17c-2-1-4.11-1.78-6.06-2.84-4.47-2.45-6.12-7.21-4.15-11.64a9.09,9.09,0,0,1,11.67-4.71c2.78,1.07,5.44,2.44,8.13,3.73,9.2,4.42,18.38,8.9,27.59,13.31,8.46,4.05,17,8,25.45,12.05C518.79,377.82,519.13,377.9,519.61,378.07Z" transform="translate(-125.43 -60.9)"/><path d="M197.8,204.41a56.66,56.66,0,0,1-25.88-7.55,55.07,55.07,0,0,1-21-21.11c-8.8-15.66-8.81-31.7-1.56-47.65a50.48,50.48,0,0,1,20.19-22.45c15.86-9.55,32.69-11.52,50.32-5.55a56.5,56.5,0,0,1,20.6,12.65,53.65,53.65,0,0,1,10.22,13.72c8.3,15,8.14,30.5,1.47,45.83a51.91,51.91,0,0,1-19.83,22.77C222.67,201.34,212,204.51,197.8,204.41Zm4.13-89.7c-14.11.19-24.54,5.26-32.13,15.26-10.06,13.24-8.08,32.56,1.68,43.25,6.85,7.49,15,12,25,13,15.15,1.46,27.42-4.2,36-16.64,8.35-12.05,6.92-30.12-2.1-40.68C222.38,119.51,212.47,115.18,201.93,114.71Z" transform="translate(-125.43 -60.9)"/><path transform="translate(-125.43 -60.9)"/></svg>
                    <img :src="mainImg" v-if="mainImg && !videoOrImg" class="width-300" alt="">
                    <video :src="video" v-if="videoOrImg"  class="width-300"></video>
                    <img src="../../../img/krest-btn.png" class="admin-delete-photo" alt="" @click="deleteImg()">
                </div>
            </div>
            <div class="admin-reviews">
                <h1 class="admin-h3">Отзывы</h1>
                <div class="users-reviews">
                    <div class="review">
                        <div class="review-wrap input-transp input-transp-p">
                           <span class="review-data">12.01.2020</span>
                           <span class="review-name">Даниил</span>
                           <div class="star-container">
                               <span><svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.9519 5.65442C14.8367 5.28455 14.5238 5.0091 14.1548 4.95246L10.1679 4.34771L8.38508 0.575386C8.22049 0.225916 7.87326 0 7.50029 0C7.12693 0 6.77916 0.225813 6.61428 0.575181L4.8319 4.34771L0.844183 4.95256C0.47575 5.009 0.163028 5.28445 0.0474144 5.65462C-0.0675617 6.02503 0.0306741 6.43978 0.297538 6.71113L3.18228 9.64834L2.50196 13.7946C2.43821 14.1783 2.59216 14.5743 2.89405 14.8032C3.06348 14.9319 3.26432 15 3.47498 15C3.63461 15 3.79351 14.9591 3.93432 14.8819L7.50032 12.924L11.0661 14.8819C11.2068 14.9591 11.3655 15 11.525 15C11.7355 15 11.9362 14.9319 12.1057 14.8032C12.4075 14.5739 12.5616 14.1781 12.4983 13.795L11.8172 9.64831L14.7025 6.7112C14.9699 6.43903 15.0679 6.02406 14.9519 5.65442ZM14.4139 6.40212L11.4508 9.41843C11.4022 9.46806 11.3798 9.53947 11.3914 9.60951L12.091 13.8683C12.1277 14.0908 12.0382 14.3209 11.8626 14.4543C11.7643 14.529 11.6476 14.5686 11.525 14.5686C11.4322 14.5686 11.3401 14.5448 11.2585 14.5L7.59652 12.4892C7.56635 12.4727 7.53338 12.4645 7.50032 12.4645C7.46725 12.4645 7.43419 12.4727 7.40414 12.4892L3.74204 14.5C3.55236 14.604 3.30998 14.5857 3.13694 14.4542C2.96152 14.3212 2.87204 14.0912 2.90914 13.868L3.60797 9.60956C3.61944 9.53963 3.59724 9.46811 3.54856 9.41858L0.585897 6.40212C0.4307 6.24427 0.373592 6.00312 0.440333 5.78821C0.507588 5.57297 0.689746 5.41263 0.903914 5.37972L4.99888 4.75856C5.06614 4.74832 5.12442 4.70417 5.15447 4.64041L6.9849 0.76603C7.08078 0.562844 7.28306 0.431559 7.50032 0.431559C7.71698 0.431559 7.91865 0.562742 8.01441 0.766132L9.84545 4.64041C9.87562 4.70417 9.93369 4.7483 10.0011 4.75856L14.0951 5.37961C14.3099 5.41263 14.492 5.57284 14.5592 5.78842C14.6264 6.00305 14.5695 6.24396 14.4139 6.40212Z" fill="#848CCF"/></svg></span>
                               <span><svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                               <path d="M14.9519 5.65442C14.8367 5.28455 14.5238 5.0091 14.1548 4.95246L10.1679 4.34771L8.38508 0.575386C8.22049 0.225916 7.87326 0 7.50029 0C7.12693 0 6.77916 0.225813 6.61428 0.575181L4.8319 4.34771L0.844183 4.95256C0.47575 5.009 0.163028 5.28445 0.0474144 5.65462C-0.0675617 6.02503 0.0306741 6.43978 0.297538 6.71113L3.18228 9.64834L2.50196 13.7946C2.43821 14.1783 2.59216 14.5743 2.89405 14.8032C3.06348 14.9319 3.26432 15 3.47498 15C3.63461 15 3.79351 14.9591 3.93432 14.8819L7.50032 12.924L11.0661 14.8819C11.2068 14.9591 11.3655 15 11.525 15C11.7355 15 11.9362 14.9319 12.1057 14.8032C12.4075 14.5739 12.5616 14.1781 12.4983 13.795L11.8172 9.64831L14.7025 6.7112C14.9699 6.43903 15.0679 6.02406 14.9519 5.65442ZM14.4139 6.40212L11.4508 9.41843C11.4022 9.46806 11.3798 9.53947 11.3914 9.60951L12.091 13.8683C12.1277 14.0908 12.0382 14.3209 11.8626 14.4543C11.7643 14.529 11.6476 14.5686 11.525 14.5686C11.4322 14.5686 11.3401 14.5448 11.2585 14.5L7.59652 12.4892C7.56635 12.4727 7.53338 12.4645 7.50032 12.4645C7.46725 12.4645 7.43419 12.4727 7.40414 12.4892L3.74204 14.5C3.55236 14.604 3.30998 14.5857 3.13694 14.4542C2.96152 14.3212 2.87204 14.0912 2.90914 13.868L3.60797 9.60956C3.61944 9.53963 3.59724 9.46811 3.54856 9.41858L0.585897 6.40212C0.4307 6.24427 0.373592 6.00312 0.440333 5.78821C0.507588 5.57297 0.689746 5.41263 0.903914 5.37972L4.99888 4.75856C5.06614 4.74832 5.12442 4.70417 5.15447 4.64041L6.9849 0.76603C7.08078 0.562844 7.28306 0.431559 7.50032 0.431559C7.71698 0.431559 7.91865 0.562742 8.01441 0.766132L9.84545 4.64041C9.87562 4.70417 9.93369 4.7483 10.0011 4.75856L14.0951 5.37961C14.3099 5.41263 14.492 5.57284 14.5592 5.78842C14.6264 6.00305 14.5695 6.24396 14.4139 6.40212Z" fill="#848CCF"/>
                           </svg></span>
                               <span><svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                               <path d="M14.9519 5.65442C14.8367 5.28455 14.5238 5.0091 14.1548 4.95246L10.1679 4.34771L8.38508 0.575386C8.22049 0.225916 7.87326 0 7.50029 0C7.12693 0 6.77916 0.225813 6.61428 0.575181L4.8319 4.34771L0.844183 4.95256C0.47575 5.009 0.163028 5.28445 0.0474144 5.65462C-0.0675617 6.02503 0.0306741 6.43978 0.297538 6.71113L3.18228 9.64834L2.50196 13.7946C2.43821 14.1783 2.59216 14.5743 2.89405 14.8032C3.06348 14.9319 3.26432 15 3.47498 15C3.63461 15 3.79351 14.9591 3.93432 14.8819L7.50032 12.924L11.0661 14.8819C11.2068 14.9591 11.3655 15 11.525 15C11.7355 15 11.9362 14.9319 12.1057 14.8032C12.4075 14.5739 12.5616 14.1781 12.4983 13.795L11.8172 9.64831L14.7025 6.7112C14.9699 6.43903 15.0679 6.02406 14.9519 5.65442ZM14.4139 6.40212L11.4508 9.41843C11.4022 9.46806 11.3798 9.53947 11.3914 9.60951L12.091 13.8683C12.1277 14.0908 12.0382 14.3209 11.8626 14.4543C11.7643 14.529 11.6476 14.5686 11.525 14.5686C11.4322 14.5686 11.3401 14.5448 11.2585 14.5L7.59652 12.4892C7.56635 12.4727 7.53338 12.4645 7.50032 12.4645C7.46725 12.4645 7.43419 12.4727 7.40414 12.4892L3.74204 14.5C3.55236 14.604 3.30998 14.5857 3.13694 14.4542C2.96152 14.3212 2.87204 14.0912 2.90914 13.868L3.60797 9.60956C3.61944 9.53963 3.59724 9.46811 3.54856 9.41858L0.585897 6.40212C0.4307 6.24427 0.373592 6.00312 0.440333 5.78821C0.507588 5.57297 0.689746 5.41263 0.903914 5.37972L4.99888 4.75856C5.06614 4.74832 5.12442 4.70417 5.15447 4.64041L6.9849 0.76603C7.08078 0.562844 7.28306 0.431559 7.50032 0.431559C7.71698 0.431559 7.91865 0.562742 8.01441 0.766132L9.84545 4.64041C9.87562 4.70417 9.93369 4.7483 10.0011 4.75856L14.0951 5.37961C14.3099 5.41263 14.492 5.57284 14.5592 5.78842C14.6264 6.00305 14.5695 6.24396 14.4139 6.40212Z" fill="#848CCF"/>
                           </svg></span>
                               <span><svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                               <path d="M14.9519 5.65442C14.8367 5.28455 14.5238 5.0091 14.1548 4.95246L10.1679 4.34771L8.38508 0.575386C8.22049 0.225916 7.87326 0 7.50029 0C7.12693 0 6.77916 0.225813 6.61428 0.575181L4.8319 4.34771L0.844183 4.95256C0.47575 5.009 0.163028 5.28445 0.0474144 5.65462C-0.0675617 6.02503 0.0306741 6.43978 0.297538 6.71113L3.18228 9.64834L2.50196 13.7946C2.43821 14.1783 2.59216 14.5743 2.89405 14.8032C3.06348 14.9319 3.26432 15 3.47498 15C3.63461 15 3.79351 14.9591 3.93432 14.8819L7.50032 12.924L11.0661 14.8819C11.2068 14.9591 11.3655 15 11.525 15C11.7355 15 11.9362 14.9319 12.1057 14.8032C12.4075 14.5739 12.5616 14.1781 12.4983 13.795L11.8172 9.64831L14.7025 6.7112C14.9699 6.43903 15.0679 6.02406 14.9519 5.65442ZM14.4139 6.40212L11.4508 9.41843C11.4022 9.46806 11.3798 9.53947 11.3914 9.60951L12.091 13.8683C12.1277 14.0908 12.0382 14.3209 11.8626 14.4543C11.7643 14.529 11.6476 14.5686 11.525 14.5686C11.4322 14.5686 11.3401 14.5448 11.2585 14.5L7.59652 12.4892C7.56635 12.4727 7.53338 12.4645 7.50032 12.4645C7.46725 12.4645 7.43419 12.4727 7.40414 12.4892L3.74204 14.5C3.55236 14.604 3.30998 14.5857 3.13694 14.4542C2.96152 14.3212 2.87204 14.0912 2.90914 13.868L3.60797 9.60956C3.61944 9.53963 3.59724 9.46811 3.54856 9.41858L0.585897 6.40212C0.4307 6.24427 0.373592 6.00312 0.440333 5.78821C0.507588 5.57297 0.689746 5.41263 0.903914 5.37972L4.99888 4.75856C5.06614 4.74832 5.12442 4.70417 5.15447 4.64041L6.9849 0.76603C7.08078 0.562844 7.28306 0.431559 7.50032 0.431559C7.71698 0.431559 7.91865 0.562742 8.01441 0.766132L9.84545 4.64041C9.87562 4.70417 9.93369 4.7483 10.0011 4.75856L14.0951 5.37961C14.3099 5.41263 14.492 5.57284 14.5592 5.78842C14.6264 6.00305 14.5695 6.24396 14.4139 6.40212Z" fill="#848CCF"/>
                           </svg></span>
                               <span><svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                               <path d="M14.9519 5.65442C14.8367 5.28455 14.5238 5.0091 14.1548 4.95246L10.1679 4.34771L8.38508 0.575386C8.22049 0.225916 7.87326 0 7.50029 0C7.12693 0 6.77916 0.225813 6.61428 0.575181L4.8319 4.34771L0.844183 4.95256C0.47575 5.009 0.163028 5.28445 0.0474144 5.65462C-0.0675617 6.02503 0.0306741 6.43978 0.297538 6.71113L3.18228 9.64834L2.50196 13.7946C2.43821 14.1783 2.59216 14.5743 2.89405 14.8032C3.06348 14.9319 3.26432 15 3.47498 15C3.63461 15 3.79351 14.9591 3.93432 14.8819L7.50032 12.924L11.0661 14.8819C11.2068 14.9591 11.3655 15 11.525 15C11.7355 15 11.9362 14.9319 12.1057 14.8032C12.4075 14.5739 12.5616 14.1781 12.4983 13.795L11.8172 9.64831L14.7025 6.7112C14.9699 6.43903 15.0679 6.02406 14.9519 5.65442ZM14.4139 6.40212L11.4508 9.41843C11.4022 9.46806 11.3798 9.53947 11.3914 9.60951L12.091 13.8683C12.1277 14.0908 12.0382 14.3209 11.8626 14.4543C11.7643 14.529 11.6476 14.5686 11.525 14.5686C11.4322 14.5686 11.3401 14.5448 11.2585 14.5L7.59652 12.4892C7.56635 12.4727 7.53338 12.4645 7.50032 12.4645C7.46725 12.4645 7.43419 12.4727 7.40414 12.4892L3.74204 14.5C3.55236 14.604 3.30998 14.5857 3.13694 14.4542C2.96152 14.3212 2.87204 14.0912 2.90914 13.868L3.60797 9.60956C3.61944 9.53963 3.59724 9.46811 3.54856 9.41858L0.585897 6.40212C0.4307 6.24427 0.373592 6.00312 0.440333 5.78821C0.507588 5.57297 0.689746 5.41263 0.903914 5.37972L4.99888 4.75856C5.06614 4.74832 5.12442 4.70417 5.15447 4.64041L6.9849 0.76603C7.08078 0.562844 7.28306 0.431559 7.50032 0.431559C7.71698 0.431559 7.91865 0.562742 8.01441 0.766132L9.84545 4.64041C9.87562 4.70417 9.93369 4.7483 10.0011 4.75856L14.0951 5.37961C14.3099 5.41263 14.492 5.57284 14.5592 5.78842C14.6264 6.00305 14.5695 6.24396 14.4139 6.40212Z" fill="#848CCF"/>
                           </svg></span>
                           </div>
                       </div>
                        <button class="btn-admin-arrow" @click="activeBtn = !activeBtn" v-bind:class="activeBtn ? 'admin-btn-arrow-pass' : 'admin-btn-arrow'"></button>
                        <img src="../../../img/krest-btn.png" alt="">
                    </div>
                    <p class="review-text input-transp input-transp-p" v-if="activeBtn">
                        Текст
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import AdminCrumbs from "../components/AdminCrumbs";
    import axios from 'axios';
    export default {
        name: "ProductCart",
        components: {AdminCrumbs},
        data: () => ({
            // Товар
            nameProduct: null,
            priceProduct: null,
            saleProduct: null,
            textProduct: null,

            // Картинки
            mainImg: null,
            loadedImg: null,
            files: [],
            clickedImg: 0,

            activeBtn: false,
            activeBtnSize: false,

            // Размеры
            amountStock: null,
            sizes: [],
            newSize: null,
            chozenSizeAfterClick: null,
            chozenSizeStockAfterClick: null,

            // Размеры, уже пришедшие с бэка
            presentSizes: null,
            timeToChangePresetnSizes: false,

            // Видео
            video: null,
            videoOrImg: false,
            loadedVideo: null,

            // Данные на сервер
            dataToBack: {},
            productSucc: false,

            // Кол-во товара, если нету размера
            stockAmountWithoutSizes: null
        }),
        methods: {
            // addSize(){
            //     if (this.newSize) this.sizes.push(this.newSize)
            // },
            pushImg(){
                let imgs = this.$refs.img.files;

                for (let i in imgs){
                    this.files.push(imgs[i]);
                }

                this.getPrevious();

                // Загруженные фотки
                this.loadedImg = imgs;
            },
            getPrevious(){
                for( let i = 0; i < this.files.length; i++ ){

                    if ( /\.(jpe?g|png|gif|svg)$/i.test(this.files[i].name) ) {

                        if (i == 0) this.files[i].active = true;
                        else this.files[i].active = false;

                        let reader = new FileReader();
                        reader.addEventListener("load", function(){
                            this.$refs['image'+parseInt(i)][0].src = reader.result;
                            if (i === 0) this.mainImg = this.$refs['image' + parseInt(i)][0].src;
                        }.bind(this), false);
                        reader.readAsDataURL(this.files[i]);
                    }
                }
                this.files = this.files.filter(el => (typeof el) === "object");
            },

            deleteImg(){
                 // Если кликнули по первой или второй фотографии
                if(this.clickedImg === 0 || this.clickedImg === 1){

                    this.files = this.files.filter(el => el.active === false);
                    this.getPrevious();

                    // Обнуляем главную картинку
                    if ((this.clickedImg === 0 || this.clickedImg === 1) && this.files.length === 0){
                        this.mainImg = null;
                    }
                }
                if (this.clickedImg > 1){
                    this.files.splice(this.clickedImg, 1);
                    this.clickedImg =  this.clickedImg - 1;
                    this.mainImg = this.$refs['image' + parseInt(this.clickedImg)][0].src;
                    this.files[this.clickedImg].active = true;
                    this.getPrevious();
                }

                if (this.videoOrImg){
                    this.video = null;
                    this.videoOrImg = false;
                }

                if (this.files.length === 0 && this.video !== null){
                    this.videoOrImg = true;
                }
            },

            loadVid(){
                if (this.video !== null) return;
                let video = this.$refs.vid.files;
                this.videoOrImg = true;
                this.video = URL.createObjectURL(video[0]);

                // Загруженные видео
                this.loadedVideo = video[0];
            },

            clickImg(i){
                this.clickedImg = i;
                this.mainImg = this.$refs['image' + parseInt(i)][0].src;
                this.files.forEach(el => {
                    el.active = false
                });
                this.files[i].active = true;

                // Делаем видео не активным
                this.videoOrImg = false;
            },

            // Клик по видео
            // Присваиваем тру и тогда в большом варианте картинки возвращается первью видео
            clickVideo(){
              this.videoOrImg = true;
            },

            // Клик по картинке и возвращаем mainImg
            getMainImg(){
                return this.mainImg;
            },

            // Отправляем данные на сервер
            sentProductData(){
                this.dataToBack = {
                    video: this.loadedVideo,
                    imgs: this.loadedImg,
                    description: this.textProduct,
                    price: this.priceProduct,
                    sale: this.saleProduct,
                    sizes: this.sizes.length ? this.sizes : null,
                    amountWithoutSizes: this.stockAmountWithoutSizes
                };
                this.$store.dispatch('SentDataToBackend', this.dataToBack);
            },

            // Выбираем рамзеры
            addNewSize(data){
                let checkSize = this.sizes.find(el => el.size === data.size && el.id === data.sizeId);
                if (checkSize) return;
                this.sizes.push({size: data.size, id: data.sizeId, count: 0})
            },

            // Выбираем размер для определения кол-во
            selectSizeForStock(i){
                this.newSize = i;
                this.chozenSizeAfterClick = this.sizes[i].size;
                this.chozenSizeStockAfterClick = this.sizes[i].count;
                this.timeToChangePresetnSizes = false
            },

            // Кликаем на старые размеры
            selectSizeForStockUpdate(count, size, i) {
                this.newSize = i;
                this.chozenSizeAfterClick = size;
                this.chozenSizeStockAfterClick = count;
                this.timeToChangePresetnSizes = true;
            },

            // Изменяем кол-во размера
            insertAmountStock(){
                 if (!this.sizes.length) {
                     this.stockAmountWithoutSizes = this.chozenSizeStockAfterClick;
                     console.log(1)
                 }else{
                     console.log(2)
                     this.sizes[this.newSize].count = this.chozenSizeStockAfterClick;
                     this.updateProduct(this.$route.params.id, 'sizeFresh', {sizeId: this.sizes[this.newSize].id, count: this.sizes[this.newSize].count});
                     console.log(this.sizes[this.newSize])
                     this.stockAmountWithoutSizes = null;
                 }
            },

            // Апдейтим кол-во для размера
            insertAmountStockUpdate(){
                console.log(this.presentSizes[this.newSize])
                this.updateProduct(this.$route.params.id, 'sizeOld', {sizeId: this.presentSizes[this.newSize].sizes_id, count: this.chozenSizeStockAfterClick});
            },

            // Удаляем размер
            deleteSize(i){
                this.sizes.splice(i, 1);

                // Если массив новых добавленных товаров  == 0, то обнуляем переменные с выводом данных
                if (!this.sizes.length) {
                    this.chozenSizeAfterClick = this.chozenSizeStockAfterClick = null;
                }
            },



            // АПДЕЙТИМ ТОВАР
            // @whatNeedToChange - имя поля, которое надо поменять
            // @newValue - новое значение
            async updateProduct(id, whatNeedToChange, newValue){
                let stringData = {
                    id: id,
                    [whatNeedToChange]: newValue
                };

                let formData = new FormData();
                formData.append('stringData',  JSON.stringify(stringData));

                await axios.post(`${this.URI}updprod`, formData)
                    .then(res => {

                        console.log('Success change', whatNeedToChange)
                    })
                    .catch(e => console.log(e))
            },


            // Апдейтим описание
            changeTextProduct(){
                this.updateProduct(this.$route.params.id, 'description', this.textProduct);
            },

            // Апдейтим цену
            changePriceProduct(){
                this.updateProduct(this.$route.params.id, 'price', this.priceProduct);
            },

            // Апдейтим sale
            changeSaleProduct(){
                let dataSale = {
                    newPrice: this.saleProduct,
                    oldPrice: this.priceProduct
                };
                this.updateProduct(this.$route.params.id, 'sale', dataSale);
            }
        },
        created(){
          this.$store.dispatch('GetAllSizes');
          this.$store.dispatch('GetOneProduct', this.$route.params.id);
          // this.$store.dispatch('GetSizeForOneProduct');
          // this.$store.dispatch('GetAllReviews')
        },
        watch: {
            files(val){
                this.files = val;
            },
            getProductSuccess(newVal, oldVal){
                if (newVal) this.$router.push({name: 'AdminProducts'});
                else console.log('Something goes wrong')
            },
            getOneProduct(newValue){
                this.textProduct = newValue[0].product_description;
                this.priceProduct = newValue[0].product_sale ? newValue[0].product_old_price : newValue[0].product_price;
                this.saleProduct = newValue[0].product_sale ? newValue[0].product_price : null;
                this.nameProduct = newValue[0].product_title;
                this.presentSizes = newValue.allSizes;
                console.log(this.presentSizes)
            }
        },
        computed: {
            getAllSizes(){
                return this.$store.getters.getAllSizes;
            },
            getProductSuccess(){
                return this.$store.getters.productSuccess;
            },
            URI(){
                return this.$store.getters.URI;
            },
            getOneProduct(){
                return this.$store.getters.oneProduct;
            }
        }
    }
</script>

<style scoped>

</style>
