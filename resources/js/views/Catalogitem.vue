<template>
    <div class="catalog-item container" v-if="returnDataForItem !== null && returnDataForItem !== undefined">
        <div class="bread"><div></div> <Breadcrumbs/> <div></div></div>
        <h1 class="item-title">
            {{returnDataForItem.itemTitle}}
        </h1>
        <div class="item-info">
            <div class="item-pics" ref="itemImgs">
                <div class="wrap" v-if="media.wind > media.tablet">
                    <div class="item-pic" v-for="(img, i) in returnDataForItem.itemPics" :key="i" @click="clickItemPic(i)">
                        <video :src="img.video" v-if="img.video"></video>
                        <svg id="cameraImPic" v-if="img.video" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 413.19 358.83"><defs></defs><title>icon_cam</title><path d="M150.57,419.73c-3.12-1-6.25-1.89-9.34-3-3.87-1.33-6.63-4.17-9.34-7.09-4.86-5.24-6.47-11.5-6.46-18.46q.06-70.32,0-140.62c0-4.32.41-8.59,2.45-12.41,5.18-9.66,13.3-15,24.31-15.77,1-.07,2.09-.06,3.14-.06q120.42,0,240.86,0c8.7,0,16.39,2.5,22.32,9a27.17,27.17,0,0,1,7.52,19q-.18,70.64,0,141.28c0,9-3.62,16-10.16,21.68a26.11,26.11,0,0,1-13.09,5.91c-.65.11-1.28.32-1.92.48ZM275.7,240.31H156c-1,0-1.95,0-2.91.06-4.58.41-7.78,3.09-8.57,7.21a16.35,16.35,0,0,0-.18,3.13v140.6c0,.75,0,1.5.05,2.24a8.54,8.54,0,0,0,6.3,7.6,20.32,20.32,0,0,0,4.85.6q120.2,0,240.39,0a16.78,16.78,0,0,0,2.46-.06c5.29-.82,8.89-3.87,8.79-9.45,0-.45,0-.9,0-1.35V251.23a20.06,20.06,0,0,0-.06-2.69c-.37-2.69-1.29-5.2-4-6.27-2.23-.88-4.63-1.87-7-1.87Q335.9,240.22,275.7,240.31Z" transform="translate(-125.43 -60.9)"/><path d="M348.48,204.43a75.79,75.79,0,0,1-34.64-9.33,77.74,77.74,0,0,1-21.13-17,70,70,0,0,1-9.82-15.1c-9.5-18.84-9.44-38.09-1.74-57.33a73.3,73.3,0,0,1,9.92-16.59,67.26,67.26,0,0,1,19.16-16.89A77.07,77.07,0,0,1,360.5,61.53a75.13,75.13,0,0,1,31.73,11.39A77.89,77.89,0,0,1,411.68,90.8c5.58,7.14,8.86,15.22,11.6,23.71a60.46,60.46,0,0,1,1,32.87c-2,8.29-4.94,16.42-9.9,23.54a76.25,76.25,0,0,1-20,20.19C381.23,199.91,366.67,204.4,348.48,204.43ZM350,78.78c-1.42.12-3.66.23-5.88.49-18.9,2.21-33.8,11.42-42.91,27.87-9.84,17.76-9.56,36.11,1.74,53.65A51.35,51.35,0,0,0,313.63,173a55.25,55.25,0,0,0,20.12,10.86c23.47,6.51,43.63.69,60.35-16.81a46.9,46.9,0,0,0,10.64-18.93c3.67-12,3.37-24-1.93-35.74a55.26,55.26,0,0,0-20.63-24.31C372.64,81.87,362.16,79,350,78.78Z" transform="translate(-125.43 -60.9)"/><path d="M519.61,378.07V264c-2.23,1-4.39,1.88-6.5,2.89q-18.74,9-37.46,18-8.56,4.11-17.17,8.13c-5.37,2.5-11.13.38-13.06-4.73a8.79,8.79,0,0,1,4.45-11.17c4.36-2.28,8.83-4.34,13.28-6.45,4.17-2,8.38-3.85,12.54-5.84,9.07-4.36,18.12-8.77,27.18-13.14,7-3.37,14-6.66,21-10.05a10.6,10.6,0,0,1,11.42.75,8.11,8.11,0,0,1,3.24,5.92,15,15,0,0,1,.06,2c0,47.16-.06,94.32.06,141.47,0,6.8-5.27,10.22-10.16,9.87a15.4,15.4,0,0,1-5.28-1.66c-12.58-6-25.12-12.07-37.68-18.1q-14.81-7.11-29.64-14.17c-2-1-4.11-1.78-6.06-2.84-4.47-2.45-6.12-7.21-4.15-11.64a9.09,9.09,0,0,1,11.67-4.71c2.78,1.07,5.44,2.44,8.13,3.73,9.2,4.42,18.38,8.9,27.59,13.31,8.46,4.05,17,8,25.45,12.05C518.79,377.82,519.13,377.9,519.61,378.07Z" transform="translate(-125.43 -60.9)"/><path d="M197.8,204.41a56.66,56.66,0,0,1-25.88-7.55,55.07,55.07,0,0,1-21-21.11c-8.8-15.66-8.81-31.7-1.56-47.65a50.48,50.48,0,0,1,20.19-22.45c15.86-9.55,32.69-11.52,50.32-5.55a56.5,56.5,0,0,1,20.6,12.65,53.65,53.65,0,0,1,10.22,13.72c8.3,15,8.14,30.5,1.47,45.83a51.91,51.91,0,0,1-19.83,22.77C222.67,201.34,212,204.51,197.8,204.41Zm4.13-89.7c-14.11.19-24.54,5.26-32.13,15.26-10.06,13.24-8.08,32.56,1.68,43.25,6.85,7.49,15,12,25,13,15.15,1.46,27.42-4.2,36-16.64,8.35-12.05,6.92-30.12-2.1-40.68C222.38,119.51,212.47,115.18,201.93,114.71Z" transform="translate(-125.43 -60.9)"/><path transform="translate(-125.43 -60.9)"/></svg>
                        <img v-bind:src="img.img" v-if="img.img" alt="" v-bind:class="img.clicked ? 'clicked-pic' : null">
                    </div>
                </div>
                <div class="wrap" v-if="media.wind <= media.tablet && returnDataForItem.itemPics.length">
                        <carousel :dots="false" :lazyLoad="true" :autoWidth="false" :items="1">
                        <div class="item-pic" v-for="(img, i) in returnDataForItem.itemPics" v-if="img.img" :key="i">
                            <img v-bind:src="img.img" alt="">
                        </div>
                        </carousel>
                </div>
            </div>

            <div class="item-main-pic" v-if="media.wind > media.tablet">
                <div class="main-icons" v-if="returnDataForItem.itemPics[mainPic].video">
<!--                    <svg id="3d" @click="chooseSvg = !chooseSvg" v-bind:class="chooseSvg ? null : 'fill-svg'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 468.29 326.47"><defs></defs><title>icon_3d</title><path d="M458.8,294.47c-.43,3.09-1.39,5.43-.95,7.47,6.42,30.18-8.65,43.78-35.22,53.16-30.79,10.87-60,26.32-90.21,38.87-5.86,2.43-14.29,2.87-20,.5q-60-24.83-119.18-51.74c-4.93-2.26-9.73-10.47-10.13-16.25-2.14-30.76-1.87-30.22-30.54-41.33-16.45-6.37-33.49-12.9-47.72-23-24.93-17.73-25.42-44.18,0-60.9,19.14-12.6,41.67-20.45,63.48-28.14,10.76-3.79,16.49-7.73,14.35-19.54-3.57-19.65,4.52-30.11,23.21-37.22,36.28-13.8,71.46-30.55,107.41-45.28,5.32-2.18,13.12-1.88,18.48.4,36.28,15.44,72,32.26,108.36,47.44,13.09,5.46,20.67,12.44,17.53,27.28-4,18.69,5.77,24.46,21.93,29.22,18.85,5.55,38,13.17,54.25,24.07,27.42,18.36,27.13,45.54-.29,64.27C518.64,273.89,500.9,279.9,484.12,287,476,290.43,467.23,292.05,458.8,294.47ZM328.48,382.84c33.07-14.36,64.53-27.78,95.79-41.65C450.33,329.63,450.5,328.83,445,298c-25.67,1.76-51.15,11.26-77,6.32-.22-2.29-.44-4.59-.65-6.88l78.77-11.65V141.26c-23,9.68-45,18.52-66.61,28.15-17.22,7.67-40.51,12.09-49.18,25.72s-3.3,37-2.64,56c.62,17.6-6.5,37,10.2,50.9C325.77,315.53,324.24,329.05,328.48,382.84ZM260.43,252l56,32.4c0-17.56-2.08-31.87.41-45.31,6.35-34.28-6.64-52.64-39.37-62.94-28.17-8.86-54.59-23.4-83.82-36.33,0,47.69-.13,92,.26,136.39,0,3.46,3.27,9.48,5.77,9.92,19.36,3.41,38.91,5.74,60.73,8.72ZM438.06,131.09c-38.8-17.27-73.6-33-108.69-48.07-4.41-1.89-11-1.63-15.5.26-28.58,12-56.86,24.85-85.27,37.32-7.5,3.3-15.12,6.32-24.68,10.29,35.18,16,67.32,30.83,99.72,45.07,6.84,3,16.08,7.34,21.77,5C362.11,165.82,398.14,149,438.06,131.09Zm20.4,150.25c27.85-5.32,52.71-12.45,73-30.41,14.47-12.82,14.69-26,.41-38.71-20.64-18.41-46.11-25.24-73.41-30.69ZM182,177c-26.64,12.67-50.36,21.78-71.72,34.83C94.8,221.23,94,236,105.64,247.33c20.93,20.43,48.11,26.93,76.32,34.25Zm11.77,120.4c2.33,15.57-8.19,32.16,14.18,40.59,30,11.32,59,25.58,88.48,38.34,5.89,2.54,12.24,4,19.2,6.22V319.44l-55.35,32.32V306.64Zm127.74,4.37-49.81-29.5V331.4Z" transform="translate(-85.95 -69.57)"/><path transform="translate(-85.95 -69.57)"/><path transform="translate(-85.95 -69.57)"/></svg>-->
                    <svg id="camera" :class="'fill-svg'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 413.19 358.83"><defs></defs><title>icon_cam</title><path d="M150.57,419.73c-3.12-1-6.25-1.89-9.34-3-3.87-1.33-6.63-4.17-9.34-7.09-4.86-5.24-6.47-11.5-6.46-18.46q.06-70.32,0-140.62c0-4.32.41-8.59,2.45-12.41,5.18-9.66,13.3-15,24.31-15.77,1-.07,2.09-.06,3.14-.06q120.42,0,240.86,0c8.7,0,16.39,2.5,22.32,9a27.17,27.17,0,0,1,7.52,19q-.18,70.64,0,141.28c0,9-3.62,16-10.16,21.68a26.11,26.11,0,0,1-13.09,5.91c-.65.11-1.28.32-1.92.48ZM275.7,240.31H156c-1,0-1.95,0-2.91.06-4.58.41-7.78,3.09-8.57,7.21a16.35,16.35,0,0,0-.18,3.13v140.6c0,.75,0,1.5.05,2.24a8.54,8.54,0,0,0,6.3,7.6,20.32,20.32,0,0,0,4.85.6q120.2,0,240.39,0a16.78,16.78,0,0,0,2.46-.06c5.29-.82,8.89-3.87,8.79-9.45,0-.45,0-.9,0-1.35V251.23a20.06,20.06,0,0,0-.06-2.69c-.37-2.69-1.29-5.2-4-6.27-2.23-.88-4.63-1.87-7-1.87Q335.9,240.22,275.7,240.31Z" transform="translate(-125.43 -60.9)"/><path d="M348.48,204.43a75.79,75.79,0,0,1-34.64-9.33,77.74,77.74,0,0,1-21.13-17,70,70,0,0,1-9.82-15.1c-9.5-18.84-9.44-38.09-1.74-57.33a73.3,73.3,0,0,1,9.92-16.59,67.26,67.26,0,0,1,19.16-16.89A77.07,77.07,0,0,1,360.5,61.53a75.13,75.13,0,0,1,31.73,11.39A77.89,77.89,0,0,1,411.68,90.8c5.58,7.14,8.86,15.22,11.6,23.71a60.46,60.46,0,0,1,1,32.87c-2,8.29-4.94,16.42-9.9,23.54a76.25,76.25,0,0,1-20,20.19C381.23,199.91,366.67,204.4,348.48,204.43ZM350,78.78c-1.42.12-3.66.23-5.88.49-18.9,2.21-33.8,11.42-42.91,27.87-9.84,17.76-9.56,36.11,1.74,53.65A51.35,51.35,0,0,0,313.63,173a55.25,55.25,0,0,0,20.12,10.86c23.47,6.51,43.63.69,60.35-16.81a46.9,46.9,0,0,0,10.64-18.93c3.67-12,3.37-24-1.93-35.74a55.26,55.26,0,0,0-20.63-24.31C372.64,81.87,362.16,79,350,78.78Z" transform="translate(-125.43 -60.9)"/><path d="M519.61,378.07V264c-2.23,1-4.39,1.88-6.5,2.89q-18.74,9-37.46,18-8.56,4.11-17.17,8.13c-5.37,2.5-11.13.38-13.06-4.73a8.79,8.79,0,0,1,4.45-11.17c4.36-2.28,8.83-4.34,13.28-6.45,4.17-2,8.38-3.85,12.54-5.84,9.07-4.36,18.12-8.77,27.18-13.14,7-3.37,14-6.66,21-10.05a10.6,10.6,0,0,1,11.42.75,8.11,8.11,0,0,1,3.24,5.92,15,15,0,0,1,.06,2c0,47.16-.06,94.32.06,141.47,0,6.8-5.27,10.22-10.16,9.87a15.4,15.4,0,0,1-5.28-1.66c-12.58-6-25.12-12.07-37.68-18.1q-14.81-7.11-29.64-14.17c-2-1-4.11-1.78-6.06-2.84-4.47-2.45-6.12-7.21-4.15-11.64a9.09,9.09,0,0,1,11.67-4.71c2.78,1.07,5.44,2.44,8.13,3.73,9.2,4.42,18.38,8.9,27.59,13.31,8.46,4.05,17,8,25.45,12.05C518.79,377.82,519.13,377.9,519.61,378.07Z" transform="translate(-125.43 -60.9)"/><path d="M197.8,204.41a56.66,56.66,0,0,1-25.88-7.55,55.07,55.07,0,0,1-21-21.11c-8.8-15.66-8.81-31.7-1.56-47.65a50.48,50.48,0,0,1,20.19-22.45c15.86-9.55,32.69-11.52,50.32-5.55a56.5,56.5,0,0,1,20.6,12.65,53.65,53.65,0,0,1,10.22,13.72c8.3,15,8.14,30.5,1.47,45.83a51.91,51.91,0,0,1-19.83,22.77C222.67,201.34,212,204.51,197.8,204.41Zm4.13-89.7c-14.11.19-24.54,5.26-32.13,15.26-10.06,13.24-8.08,32.56,1.68,43.25,6.85,7.49,15,12,25,13,15.15,1.46,27.42-4.2,36-16.64,8.35-12.05,6.92-30.12-2.1-40.68C222.38,119.51,212.47,115.18,201.93,114.71Z" transform="translate(-125.43 -60.9)"/><path transform="translate(-125.43 -60.9)"/></svg>
                </div>
                <video :src="returnDataForItem.itemPics[mainPic].video" type="video/mp4" autoplay muted loop preload="auto" v-if="returnDataForItem.itemPics[mainPic].video !== false && mainPic === 0">
                </video>
                <div class="item-wrap-img" ref="zoom" v-if="returnDataForItem.itemPics[mainPic].video === false || mainPic > 0" @mousemove="ZoomImg">
<!--                    <img class="plus" :src="returnDataForItem.itemPics[mainPic].img" v-if="returnDataForItem.itemPics[mainPic].video === false || mainPic > 0">-->
                    <div class="img normal" :style="{backgroundImage: `url(${returnDataForItem.itemPics[mainPic].img})`}"></div>
                    <div class="img zoom" :style="{backgroundImage:`url(${returnDataForItem.itemPics[mainPic].img})`}"></div>
                </div>
            </div>

            <div class="item-main-info">
                <div class="item-main-wrap">

                    <div class="price-wrap" v-if="showPriceAsUsual">
                        <div class="item-main-price" v-if="returnDataForItem.oldPrice">
                            <span class="through-line">{{returnDataForItem.oldPrice}} &#8381;</span> <span class="sale">{{returnDataForItem.itemPrice}} &#8381;</span>
                        </div>
                        <div class="item-main-price" v-else>
                            {{returnDataForItem.itemPrice}} &#8381;
                        </div>
                    </div>
                    <div class="item-main-price" v-else>
                        {{returnDataForItem.oldPrice}} &#8381;
                    </div>
                    <span class="sizes" v-if="returnDataForItem.itemSizes.length">Размеры</span>
                    <div class="item-main-sizes">

                        <button v-for="(size, s) in returnDataForItem.itemSizes" @click="chozenSize(s, size.sz)" :class="{activeSize: size.active || myCart.find(cartSize => (cartSize.id === returnDataForItem.itemId && cartSize.size === size.sz))}">
                            {{size.sz}}
                        </button>

                    </div>
                    <div class="error-add" v-if="errorAdd">
                        Пожалуйста, укажите размер.
                    </div>
                    <div class="item-buttons">
                        <button class="btn-cart" @click="addToCart(returnDataForItem.itemId, returnDataForItem.itemPrice, returnDataForItem.oldPrice)">
                            Добавить в корзину
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 510.2 418.41"><defs></defs><title>icon_kor</title><path d="M552.72,93.5c-.77,3.55-1.1,7.26-2.39,10.61q-5.24,13.55-11.15,26.83-27,60.36-54.24,120.61a187.52,187.52,0,0,1-9.51,17.29c-6.51,11.1-16.9,15.39-29.17,16.13-3.11.19-6.24.2-9.36.2H210.66a62,62,0,0,0,8,17c7.14,10.51,16.82,15.78,29.82,15.75,64.81-.18,129.63-.09,194.44-.08a20.25,20.25,0,0,1,4.13.26,10.44,10.44,0,0,1,8.35,11.25,10.59,10.59,0,0,1-9.85,9.71c-1,.09-2.09.05-3.13.05-64.37,0-128.75-.15-193.13.08-21.91.08-38-9.46-49.64-27.46-6.72-10.41-10-22.12-13.3-33.94-8.74-31.45-17.85-62.8-27-94.14C148.26,145.41,136.94,107.22,125.7,69c-2.74-9.34-13.21-17.12-23.47-17.18-16-.1-32.1,0-48.15,0-5.21,0-9-2.42-10.77-6.68-2.75-6.75,2.06-14.52,9.38-14.52,21.17,0,42.34,0,63.49.62,5.3.14,10.77,1.88,15.75,3.89,7.21,2.92,11.72,8.75,13.81,16.27q29.14,104.75,58.18,209.5c.69,2.49,1.68,3.19,4.2,3.18q114.66-.1,229.31-.06c2.78,0,5.55-.18,8.32-.25,5.67-.14,10-2.41,12.64-7.61,5.07-10,10.53-19.91,15.16-30.16q27.33-60.5,54.14-121.22a48.89,48.89,0,0,0,3.56-13.48c.89-7-.71-8.5-7.75-8.55s-14.05.08-21.08.09q-58.95.06-117.91.09c-22.73,0-45.46-.08-68.19-.1L200,82.7c-6.46,0-10.43-2.71-11.84-8a10.46,10.46,0,0,1,8.09-13,25,25,0,0,1,4.66-.31q132.09.07,264.19.19c18.74,0,37.48-.22,56.22-.14a52.19,52.19,0,0,1,12.6,1.4c10.22,2.63,16.16,9.56,18.27,19.84.14.65.37,1.29.55,1.94Z" transform="translate(-42.53 -30.59)"/><path d="M437.67,449c-4.33-1.14-8.81-1.9-13-3.5A49.57,49.57,0,0,1,437.16,350c26.07-3,50.22,15.1,54.56,40.83,4.41,26.13-12.49,51.39-38.13,57-1.83.4-3.67.78-5.51,1.17Zm-24.18-49.62a29.39,29.39,0,0,0,29.34,29.25c15.94-.07,29.24-13.38,29.16-29.19a29.25,29.25,0,1,0-58.5-.06Z" transform="translate(-42.53 -30.59)"/><path d="M235.67,449c-5.22-1.5-10.69-2.42-15.61-4.6-20.4-9-31.76-30.29-28.6-52.74,2.94-20.83,20.25-38.15,41.44-41.46,27.06-4.22,53,14.75,56.84,41.67A49.75,49.75,0,0,1,247,448.55a8.76,8.76,0,0,0-1.46.45Zm4.85-78.92a29.28,29.28,0,1,0,.22,58.55c15.84-.11,29.07-13.29,29.09-29A29.38,29.38,0,0,0,240.52,370.08Z" transform="translate(-42.53 -30.59)"/><path class="cls-1" d="M413.49,399.38a29.25,29.25,0,1,1,58.5.06c.08,15.81-13.22,29.12-29.16,29.19A29.39,29.39,0,0,1,413.49,399.38Z" transform="translate(-42.53 -30.59)"/><path class="cls-1" d="M240.52,370.08a29.38,29.38,0,0,1,29.31,29.55c0,15.71-13.25,28.89-29.09,29a29.28,29.28,0,1,1-.22-58.55Z" transform="translate(-42.53 -30.59)"/>
                            </svg>
                        </button>
                        <button class="btn btn-buynow" @click="addToCartOneClick(returnDataForItem.itemId, returnDataForItem.itemPrice, returnDataForItem.oldPrice)">Купить в 1 клик</button>
                    </div>
                </div>
            </div>

        </div>
        <div class="item-description">
            <p>
                <span class="boldinfo">Информация о товаре: </span>
                {{returnDataForItem.itemDesc}}
            </p>
        </div>
        <div class="item-review">
            <h1>Отзывы</h1>
            <div class="review-wrap">
                <div class="review-user-wrap">
                    <div class="review-user" v-for="(inf, i) in returnReviewForItem">
                        <div class="user-info">
                            <span class="user-stars" v-for="item in 5">
                                <svg viewBox="0 0 18 17">
    <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Rounded" transform="translate(-273.000000, -4323.000000)">
            <g id="Toggle" transform="translate(100.000000, 4266.000000)">
                <g id="-Round-/-Toggle-/-star" transform="translate(170.000000, 54.000000)">
                    <g>
                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                        <path v-bind:class="inf.reviews_star >= item ? 'filled' : null" d="M12,17.27 L16.15,19.78 C16.91,20.24 17.84,19.56 17.64,18.7 L16.54,13.98 L20.21,10.8 C20.88,10.22 20.52,9.12 19.64,9.05 L14.81,8.64 L12.92,4.18 C12.58,3.37 11.42,3.37 11.08,4.18 L9.19,8.63 L4.36,9.04 C3.48,9.11 3.12,10.21 3.79,10.79 L7.46,13.97 L6.36,18.69 C6.16,19.55 7.09,20.23 7.85,19.77 L12,17.27 Z"></path>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg>
                            </span>
                            <span class="user-name"> {{inf.lappiusers_name}}  / </span>
                            <span class="user-date"> {{inf.reviews_created.split('-').reverse().join('-')}}</span>
                        </div>
                        <p class="user-text">
                            {{inf.reviews_text}}
                        </p>
                    </div>
                    <p v-if="!reviewsTotalPages" class="review-user-no">На данный товар пока нет отзывов.</p>
                </div>

                <div class="review-leave">
                    <div class="leave-stars" v-if="media.wind > media.tablet">
                        <div class="stars">
                            <span v-for="item in 5">
                                <svg width="18px" height="17px" viewBox="0 0 18 17">
    <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Rounded" transform="translate(-273.000000, -4323.000000)">
            <g id="Toggle" transform="translate(100.000000, 4266.000000)">
                <g id="-Round-/-Toggle-/-star" transform="translate(170.000000, 54.000000)">
                    <g>
                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                        <path class="filled" d="M12,17.27 L16.15,19.78 C16.91,20.24 17.84,19.56 17.64,18.7 L16.54,13.98 L20.21,10.8 C20.88,10.22 20.52,9.12 19.64,9.05 L14.81,8.64 L12.92,4.18 C12.58,3.37 11.42,3.37 11.08,4.18 L9.19,8.63 L4.36,9.04 C3.48,9.11 3.12,10.21 3.79,10.79 L7.46,13.97 L6.36,18.69 C6.16,19.55 7.09,20.23 7.85,19.77 L12,17.27 Z" id="🔹-Icon-Color"></path>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg>

                            </span>
                            <span v-for="item in 5">
                                <svg width="18px" height="17px" v-bind:class="4 >= item ? 'filled' : null" viewBox="0 0 18 17">
    <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Rounded" transform="translate(-273.000000, -4323.000000)">
            <g id="Toggle" transform="translate(100.000000, 4266.000000)">
                <g id="-Round-/-Toggle-/-star" transform="translate(170.000000, 54.000000)">
                    <g>
                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                        <path v-bind:class="4 >= item ? 'filled' : null" d="M12,17.27 L16.15,19.78 C16.91,20.24 17.84,19.56 17.64,18.7 L16.54,13.98 L20.21,10.8 C20.88,10.22 20.52,9.12 19.64,9.05 L14.81,8.64 L12.92,4.18 C12.58,3.37 11.42,3.37 11.08,4.18 L9.19,8.63 L4.36,9.04 C3.48,9.11 3.12,10.21 3.79,10.79 L7.46,13.97 L6.36,18.69 C6.16,19.55 7.09,20.23 7.85,19.77 L12,17.27 Z" id="🔹-Icon-Color"></path>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg>
                            </span>
                            <span v-for="item in 5">
                                <svg width="18px" height="17px" viewBox="0 0 18 17">
    <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Rounded" transform="translate(-273.000000, -4323.000000)">
            <g id="Toggle" transform="translate(100.000000, 4266.000000)">
                <g id="-Round-/-Toggle-/-star" transform="translate(170.000000, 54.000000)">
                    <g>
                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                        <path v-bind:class="3 >= item ? 'filled' : null" d="M12,17.27 L16.15,19.78 C16.91,20.24 17.84,19.56 17.64,18.7 L16.54,13.98 L20.21,10.8 C20.88,10.22 20.52,9.12 19.64,9.05 L14.81,8.64 L12.92,4.18 C12.58,3.37 11.42,3.37 11.08,4.18 L9.19,8.63 L4.36,9.04 C3.48,9.11 3.12,10.21 3.79,10.79 L7.46,13.97 L6.36,18.69 C6.16,19.55 7.09,20.23 7.85,19.77 L12,17.27 Z" id="🔹-Icon-Color"></path>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg>
                            </span>
                            <span v-for="item in 5">
                                <svg width="18px" height="17px" viewBox="0 0 18 17">
    <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Rounded" transform="translate(-273.000000, -4323.000000)">
            <g id="Toggle" transform="translate(100.000000, 4266.000000)">
                <g id="-Round-/-Toggle-/-star" transform="translate(170.000000, 54.000000)">
                    <g>
                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                        <path v-bind:class="2 >= item ? 'filled' : null" d="M12,17.27 L16.15,19.78 C16.91,20.24 17.84,19.56 17.64,18.7 L16.54,13.98 L20.21,10.8 C20.88,10.22 20.52,9.12 19.64,9.05 L14.81,8.64 L12.92,4.18 C12.58,3.37 11.42,3.37 11.08,4.18 L9.19,8.63 L4.36,9.04 C3.48,9.11 3.12,10.21 3.79,10.79 L7.46,13.97 L6.36,18.69 C6.16,19.55 7.09,20.23 7.85,19.77 L12,17.27 Z" id="🔹-Icon-Color"></path>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg>
                            </span>
                            <span v-for="item in 5">
                                <svg width="18px" height="17px" viewBox="0 0 18 17">
    <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Rounded" transform="translate(-273.000000, -4323.000000)">
            <g id="Toggle" transform="translate(100.000000, 4266.000000)">
                <g id="-Round-/-Toggle-/-star" transform="translate(170.000000, 54.000000)">
                    <g>
                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                        <path v-bind:class="1 >= item ? 'filled' : null" d="M12,17.27 L16.15,19.78 C16.91,20.24 17.84,19.56 17.64,18.7 L16.54,13.98 L20.21,10.8 C20.88,10.22 20.52,9.12 19.64,9.05 L14.81,8.64 L12.92,4.18 C12.58,3.37 11.42,3.37 11.08,4.18 L9.19,8.63 L4.36,9.04 C3.48,9.11 3.12,10.21 3.79,10.79 L7.46,13.97 L6.36,18.69 C6.16,19.55 7.09,20.23 7.85,19.77 L12,17.27 Z" id="🔹-Icon-Color"></path>
                    </g>
                </g>
            </g>
        </g>
    </g>
</svg>
                            </span>
                        </div>
                        <div class="star-amount">
                            <span v-for="(el, star, i) in returnCatalogItemStars" v-if="star == 5">
                                {{el.length}}
                            </span>
                            <span v-for="(el, star, i) in returnCatalogItemStars" v-if="star == 4">
                                {{el.length}}
                            </span>
                            <span v-for="(el, star, i) in returnCatalogItemStars" v-if="star == 3">
                                {{el.length}}
                            </span>
                            <span v-for="(el, star, i) in returnCatalogItemStars" v-if="star == 2">
                                {{el.length}}
                            </span>
                            <span v-for="(el, star, i) in returnCatalogItemStars" v-if="star == 1">
                                {{el.length}}
                            </span>
                        </div>
                    </div>
                    <button class="leave-btn" @click="leaveReview()" :class="{hideBtn: reviewBool}">Оставить отзыв</button>
                    <p v-if="successSentReview" class="reviewleave-success">Отзыв успешно отправлен.</p>
                    <button class="leave-btn" @click="sentReview()" v-if="reviewBool">Отправить</button>
                    <div class="reviewleave-stars" v-if="reviewBool">
                        <div class="wrap-reviewleave-stars" v-for="(star) in 5">
                            <input type="radio" name="leaveStar" :id="'starId'+star" :value="star" @change="starReview = star">
                            <label :for="'starId'+star">
                                <svg width="20" height="20" viewBox="0 0 20 20" :class="starReview >= star ? 'filled-leave' : 'pale-stroke'" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19.9359 7.53923C19.7822 7.04607 19.3651 6.6788 18.873 6.60328L13.5572 5.79695L11.1801 0.767182C10.9607 0.301221 10.4977 0 10.0004 0C9.50258 0 9.03888 0.301084 8.81905 0.766909L6.44253 5.79695L1.12558 6.60341C0.634333 6.67867 0.21737 7.04593 0.0632192 7.5395C-0.0900822 8.03338 0.0408988 8.58637 0.396717 8.94817L4.24304 12.8644L3.33595 18.3928C3.25095 18.9044 3.45621 19.4324 3.85873 19.7376C4.08464 19.9092 4.35242 20 4.63331 20C4.84615 20 5.05801 19.9455 5.24576 19.8425L10.0004 17.232L14.7548 19.8425C14.9424 19.9455 15.154 20 15.3667 20C15.6473 20 15.915 19.9093 16.1409 19.7376C16.5434 19.4319 16.7488 18.9041 16.6643 18.3934L15.7563 12.8644L19.6033 8.94827C19.9599 8.58538 20.0905 8.03208 19.9359 7.53923ZM19.2185 8.53616L15.2678 12.5579C15.2029 12.6241 15.1731 12.7193 15.1886 12.8127L16.1213 18.4911C16.1703 18.7877 16.0509 19.0945 15.8169 19.2724C15.6857 19.372 15.5301 19.4248 15.3667 19.4248C15.243 19.4248 15.1201 19.3931 15.0113 19.3333L10.1287 16.6523C10.0885 16.6303 10.0445 16.6194 10.0004 16.6194C9.95634 16.6194 9.91225 16.6303 9.87219 16.6523L4.98939 19.3333C4.73648 19.472 4.41331 19.4477 4.18259 19.2723C3.9487 19.0949 3.82938 18.7883 3.87886 18.4907L4.81063 12.8127C4.82592 12.7195 4.79631 12.6241 4.73141 12.5581L0.781196 8.53616C0.574267 8.32569 0.498123 8.00416 0.587111 7.71762C0.676784 7.43063 0.919661 7.21685 1.20522 7.17296L6.66518 6.34475C6.75485 6.3311 6.83257 6.27223 6.87263 6.18721L9.3132 1.02137C9.44104 0.750459 9.71075 0.575412 10.0004 0.575412C10.2893 0.575412 10.5582 0.750322 10.6859 1.02151L13.1273 6.18721C13.1675 6.27223 13.2449 6.33107 13.3348 6.34475L18.7934 7.17282C19.0798 7.21685 19.3227 7.43046 19.4122 7.71789C19.5019 8.00406 19.426 8.32528 19.2185 8.53616Z"/>
                                </svg>
                            </label>
                        </div>
                    </div>
                    <textarea v-if="reviewBool" class="input-transp input-transp-p" v-model="reviewText"></textarea>
                </div>
            </div>
            <paginate
                v-model="updatedPage"
                :page-count="Math.ceil(reviewsTotalPages / 3)"
                :click-handler="pageChange"
                :page-range="3"
                :prev-text="'Назад'"
                :next-text="'Следующая страница'"
                :page-class="'pages'"
                :prev-class="'this-page'"
                :next-class="'next-page'"
                :active-class="'sale'"
                :container-class="'pagination'"
                v-if="media.wind > media.tablet && reviewsTotalPages">
            </paginate>
            <paginate
                v-if="media.wind <= media.tablet && reviewsTotalPages"
                v-model="updatedPage"
                :page-range="3"
                :page-count="Math.ceil(reviewsTotalPages / 3)"
                :click-handler="pageChange"
                :prev-text="''"
                :next-text="''"
                :page-class="'pages'"
                :prev-class="'this-page'"
                :next-class="'next-page'"
                :active-class="'sale'"
                :container-class="'pagination'">
            </paginate>
        </div>
        <div class="item-related-products" v-if="returnDataForItem.relatedProducts.length">
            <h1>К этом товару подходят</h1>
            <carousel :dots="false" :lazyLoad="false" :autoWidth="false" :responsive="{0:{items:1,nav:true},769:{items:3,nav:true}}">
                <div class="slide-wrap" v-for='(img, ii) in returnDataForItem.relatedProducts' :key="ii">
                    <div class="img-container" @click="pushToProduct(img.product_id)">
                        <img :src="img.product_img.split(',')[0]" alt="">
                    </div>
                    <span class="slide-title">{{img.product_title}}</span>
                    <span class="slide-price" :class="img.product_old_price !== null ? 'sale' : null">{{parseInt(img.product_price) * returnDataForItem.eu}} ₽</span>
                </div>
            </carousel>
        </div>
    </div>
</template>

<script>
    import Breadcrumbs from "../components/Breadcrumbs"
    import carousel from 'vue-owl-carousel'
    import axios from 'axios'
    export default {
        name: "Catalogitem",
        components: {Breadcrumbs, carousel},
        data: () =>({
            mainPic: 0,
            chooseSvg: true,
            clickedSize: null,
            pageReview: 1,
            productId: null,
            errorAdd: false,
            noSizes: false,
            reviewBool: false,
            reviewText: null,
            starReview: null,
            successSentReview: false,
            linkForRelated: null,
            showPriceAsUsual: true,
            title: null,
            content: null
        }),
        metaInfo(){
            return {
                title: this.title,
                meta: [{
                    name: 'description',
                    content: this.content,
                }]
            }
        },
        async created(){
           this.$Progress.start();

           // Присваеваем переменной значения из урла, чтобы можно было кидать ссылки и открывались страница с отзывами указанными в урле
           this.pageReview = +this.$route.query.page || 1;

           // Получаем данные товара
           await this.$store.dispatch('getItemData', this.$route.params.number);

           //Получаем отзывы
           this.getItemReview(this.pageReview);

           this.linkForRelated = this.$route.params.gender;
       },
        methods: {
            ZoomImg(event){
                let container = this.$refs.zoom;
                let imgZoom = container.children[1];


                let e = {
                    w: imgZoom.offsetWidth,
                    h: imgZoom.offsetHeight
                };

                let c = {
                    x: Math.round((event.clientX - (container.offsetLeft - window.scrollX)) / (e.w / 30)),
                    y: Math.round((event.clientY - (container.offsetTop - window.scrollY)) / (e.h / 95))
                };
                imgZoom.style.backgroundPosition = c.x + '% ' + c.y + '%';
                // console.log(c)
            },
            // Кликаем по фотографии товара
            clickItemPic(i){
                this.mainPic = i;
                this.returnDataForItem.itemPics.forEach(el => el.clicked = false);
                this.returnDataForItem.itemPics[i].clicked = true;
            },
            chozenSize(i, size){
                this.returnDataForItem.itemSizes[i].active = !this.returnDataForItem.itemSizes[i].active;
                this.clickedSize = this.returnDataForItem.itemSizes.filter(el => el.active === true);

                let findSizeWithNoSale = this.returnDataForItem.sizeWithoutSale.find(sizeNosale => sizeNosale === size);

                findSizeWithNoSale ? this.showPriceAsUsual = false : this.showPriceAsUsual = true;

            },

            // Отправляем запрос во vuex на получение отзывов
            // item: id товара
            // page: номер страницы, подефолту 1
            getItemReview(page){
                let reviewData = {
                    item: this.$route.params.number,
                    page: page
                };
                this.$store.dispatch('getItemReviews', reviewData);
            },

            // Обработчик по нажатию на страницы в отызваъ
            // Вызываем функцию, которая выводит отзывы
            // Отображаем в урл ЧПУ
            pageChange(page){
                // Присваиваем переменной выбранную таблицу по клику на пагинцию
                this.pageReview = page;
                this.getItemReview(this.pageReview);
                this.$router.push(`${this.$route.path}?page=${this.pageReview}`)
            },

            addToCart(itemId, itemPrice, oldPrice){

                // Если длинна вообще есть размеры, то проверяем выбраны ли размеры
                if (this.returnDataForItem.itemSizes.length) {

                    if (this.clickedSize !== null) {

                        let data = [];
                        this.clickedSize.forEach(el => {
                            let findSizeWithNoSale = this.returnDataForItem.sizeWithoutSale.find(size => size === el.sz);

                            if (findSizeWithNoSale) {
                                data.push({id: itemId, count: 1, size: el.sz, price: oldPrice, catalog_size_id: el.catalog_size_id});
                            } else {
                                data.push({id: itemId, count: 1, size: el.sz, price: itemPrice, catalog_size_id: el.catalog_size_id});
                            }

                        });
                        this.$store.dispatch('addToCart', data);
                    }else{
                        this.errorAdd = true;
                    }
                }else{
                    this.$store.dispatch('addToCart', [{id: itemId, count: 1, size: null, price: itemPrice}]);
                }
            },
            addToCartOneClick(itemId, itemPrice, oldPrice){
                // Если длинна вообще есть размеры, то проверяем выбраны ли размеры
                if (this.returnDataForItem.itemSizes.length) {

                    if (this.clickedSize !== null) {
                        let data = [];
                        this.clickedSize.forEach(el => {
                            let findSizeWithNoSale = this.returnDataForItem.sizeWithoutSale.find(size => size === el.sz);
                            if (findSizeWithNoSale) data.push({id: itemId, count: 1, size: el.sz, price: oldPrice, catalog_size_id: el.catalog_size_id});
                            else data.push({id: itemId, count: 1, size: el.sz, price: itemPrice, catalog_size_id: el.catalog_size_id});
                        });
                        this.$store.dispatch('addToCart', data).then(() => this.$router.push({name: 'cart'}));
                    }else{
                        this.errorAdd = true;
                    }
                }else{
                    this.$store.dispatch('addToCart', [{id: itemId, count: 1, size: null, price: itemPrice}]).then(() => this.$router.push({name: 'cart'}));
                }
            },
            leaveReview(){
                if (this.authBool){
                    this.reviewBool = !this.reviewBool;
                }else{
                    this.$router.push({name: 'login'})
                }

            },
            async sentReview(){
                if (this.reviewText == null && this.starReview == null) return;
                let review = {
                    review_text: this.reviewText,
                    review_star: this.starReview,
                    token: localStorage.getItem('token'),
                    product_id: this.$route.params.number
                };
                await axios.post(`${this.returnURI}newreview`, review)
                    .then(res => {
                        if (res.data) {
                            this.reviewBool = !this.reviewBool;
                            this.successSentReview = !this.successSentReview;
                        }
                    })
                    .catch(e => console.log(e))
            },
            async pushToProduct(id){
                await this.$router.push(`item-${id}`);
            }
        },
        beforeDestroy() {
          this.$store.dispatch('DestroyCatalogItem')
        },
        computed: {
            // Возвращаем дату для товара
            returnDataForItem(){
                if (this.$store.getters.catalogItem !== null) {
                    this.$Progress.finish();
                    return this.$store.getters.catalogItem;
                }
            },
            // Возвращаем отзывы для товара
            returnReviewForItem(){
                if (this.$store.getters.catalogItemReview !== null) return this.$store.getters.catalogItemReview.reverse();
            },
            // Возвращаем звезды для товара
            returnCatalogItemStars(){
                return this.$store.getters.catalogItemStars;
            },
            // Возвращаем колличество страницы для отзывов
            reviewsTotalPages(){
                return this.$store.getters.catalogItemReviewCount;
            },
            // Обнавляем текущую страницы с отзывами
            updatedPage:{
                get(){
                    return this.pageReview;
                },
                set(val){
                    this.pageReview = val;
                }
            },

            returnURI(){
                return this.$store.getters.URI;
            },
            authBool(){
                return this.$store.getters.isLoggedIn;
            },
            media(){
                return this.$store.getters.media;
            },
            myCart(){
                return this.$store.getters.cart;
            }
        },
        watch: {
           $route(to){
                if (to.name === 'item'){
                    this.$Progress.start();
                    this.$store.dispatch('getItemData', this.$route.params.number);
                }
            },
            returnDataForItem(data){
             this.title = data.itemTitle
             this.content = data.itemDesc
            }
        }
    }
</script>

<style scoped>

</style>
