<template>
    <nav>
        <vue-progress-bar v-if="media.wind <= media.tablet"></vue-progress-bar>
        <div class="menu-top">
            <ul class="grid-nav-top container">
                <li class="wrap-hamburger">
                    <form class="nav-search" v-if="media.wind > media.tablet">
                        <div class="search">
                            <input type="search" id="search" placeholder="Поиск">
                            <label for="search">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="22px" height="24px" viewBox="0 0 22 24" enable-background="new 0 0 22 24">
                                    <image width="22" height="24" x="0" y="0" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAYCAQAAABUt8XAAAAABGdBTUEAALGPC/xhBQAAACBjSFJN
AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAHdElN
RQfkCRMKHQmFmjhaAAABw0lEQVQ4y43SvWtTYRTH8W/SpO21poZKlRoQilVxKfiCOjgoDmL+ARct
oji4OAi+IFgEJ6cOvmwKDoroYhG0WHxDiFshUgTFraAGUq1pSdRCvg43lxvbBPs7y33gw3MfzjkJ
+ScdpMlQ5wd1liXV9J3lEEPspkyOT0xSYHaJNqpjjlu1bpSarzzjOmNBovGMUS4SMM9nJhngCzny
9CHjnOR7880Jz6n6zBEHTdtpxlUe9JaL6k0z0c2IB5xXnzjQ/Esx4w1VL5mOcOAjtWj/EorY6x11
2k0R3mFVPdGCIu61pB4NT0mGCfjKBK1TpAjsCQ9JtgHvKbfBNaaBzfSEeDUw12pejcwBPXSHuARk
SbfFWaBCNcQfgSFybWiKncAMtRB/4BuD7G+D97ELmIomGHhfnXJri8alfKy+dUM8wcOW1TdR6xuV
tNcxVa82jzvpKRfUF47Yb4drxY0e8UFj/16aizGmvGJF1Xde8563fW1Vrfhb1YduiTFi3rvOGKfq
U4971kVVn9sX7zNAwHaGybPAL2YpUKBEJ2OcJkGdCS4v70DgelPRUopdXvBPeDv+vzq9blUdTcgK
0sV5ulkhhjX8hL+Lj5IQ+tNauAAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAyMC0wOS0xOVQxMDoyOTow
OSswMzowMDZZp/IAAAAldEVYdGRhdGU6bW9kaWZ5ADIwMjAtMDktMTlUMTA6Mjk6MDkrMDM6MDBH
BB9OAAAAAElFTkSuQmCC" />
</svg>
                            </label>
                        </div>
                    </form>
                    <div class="hamburger" @click="EatHamburger()" v-else>
                        <span></span><span></span><span></span>
                    </div>
                </li>
                <router-link class="flexin-center logo" tag="li" to="/">
                    <a href="#">
                        <svg viewBox="0 0 60 14" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <rect width="60" height="13.9535" fill="url(#pattern0)"/>
                            <defs>
                                <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0" transform="translate(0 -0.00758157) scale(0.00191939 0.00825336)"/>
                                </pattern>
                                <image id="image0" width="521" height="123" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAgkAAAB7CAYAAAD+FxMbAAABN2lDQ1BBZG9iZSBSR0IgKDE5OTgpAAAokZWPv0rDUBSHvxtFxaFWCOLgcCdRUGzVwYxJW4ogWKtDkq1JQ5ViEm6uf/oQjm4dXNx9AidHwUHxCXwDxamDQ4QMBYvf9J3fORzOAaNi152GUYbzWKt205Gu58vZF2aYAoBOmKV2q3UAECdxxBjf7wiA10277jTG+38yH6ZKAyNguxtlIYgK0L/SqQYxBMygn2oQD4CpTto1EE9AqZf7G1AKcv8ASsr1fBBfgNlzPR+MOcAMcl8BTB1da4Bakg7UWe9Uy6plWdLuJkEkjweZjs4zuR+HiUoT1dFRF8jvA2AxH2w3HblWtay99X/+PRHX82Vun0cIQCw9F1lBeKEuf1UYO5PrYsdwGQ7vYXpUZLs3cLcBC7dFtlqF8hY8Dn8AwMZP/fNTP8gAAAAJcEhZcwAACxMAAAsTAQCanBgAAAW5aVRYdFhNTDpjb20uYWRvYmUueG1wAAAAAAA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA2LjAtYzAwMiA3OS4xNjQzNTIsIDIwMjAvMDEvMzAtMTU6NTA6MzggICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0RXZ0PSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VFdmVudCMiIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCAyMS4xIChXaW5kb3dzKSIgeG1wOkNyZWF0ZURhdGU9IjIwMjAtMDgtMTlUMTY6MzErMDM6MDAiIHhtcDpNZXRhZGF0YURhdGU9IjIwMjAtMDgtMTlUMTY6MzErMDM6MDAiIHhtcDpNb2RpZnlEYXRlPSIyMDIwLTA4LTE5VDE2OjMxKzAzOjAwIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjhmODRlNDI4LTg5YzMtN2E0Mi05ZjAzLTI4YjcwMDEwNWRhZSIgeG1wTU06RG9jdW1lbnRJRD0iYWRvYmU6ZG9jaWQ6cGhvdG9zaG9wOjM3YmQ5MTE5LTdlMGItNWU0My04NDNmLWE2NDZlZGRhZTcwMCIgeG1wTU06T3JpZ2luYWxEb2N1bWVudElEPSJ4bXAuZGlkOjU1NjI3MTIwLWNkODgtZjI0OS05ZmU3LTBmNmVhZjIxODZkZCIgZGM6Zm9ybWF0PSJpbWFnZS9wbmciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiPiA8eG1wTU06SGlzdG9yeT4gPHJkZjpTZXE+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJjcmVhdGVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjU1NjI3MTIwLWNkODgtZjI0OS05ZmU3LTBmNmVhZjIxODZkZCIgc3RFdnQ6d2hlbj0iMjAyMC0wOC0xOVQxNjozMSswMzowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIDIxLjEgKFdpbmRvd3MpIi8+IDxyZGY6bGkgc3RFdnQ6YWN0aW9uPSJzYXZlZCIgc3RFdnQ6aW5zdGFuY2VJRD0ieG1wLmlpZDo4Zjg0ZTQyOC04OWMzLTdhNDItOWYwMy0yOGI3MDAxMDVkYWUiIHN0RXZ0OndoZW49IjIwMjAtMDgtMTlUMTY6MzErMDM6MDAiIHN0RXZ0OnNvZnR3YXJlQWdlbnQ9IkFkb2JlIFBob3Rvc2hvcCAyMS4xIChXaW5kb3dzKSIgc3RFdnQ6Y2hhbmdlZD0iLyIvPiA8L3JkZjpTZXE+IDwveG1wTU06SGlzdG9yeT4gPC9yZGY6RGVzY3Jp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"/>
                            </defs>
                        </svg>
                    </a>
                </router-link>
                <li class="nav-icons">
                    <ul class="nav-icons-items">
                        <router-link tag="li" :to="{name: 'login'}" v-if="!isLoggedIn">
                            <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448.51 426.18"><title>icon_lk</title><path d="M553,389.48c-1.08,4.89-1.81,9.89-3.31,14.65-3.57,11.27-8.4,22.08-16.72,30.64-11.7,12-26.16,18.57-43.11,18.6q-126.32.21-252.64.27c-24,0-48.05.3-72.08,0-23.72-.25-41.08-11-51.6-32.54-11.89-24.32-11.41-49-2.4-73.9,8.17-22.57,22.45-40.88,40.33-56.55,10.85-9.52,26.19-20.05,35.44-24.59l13.9,14.7c-5.09,3-10.34,5.94-15.39,9.18-18.84,12.09-35.16,26.8-46.82,46.17-9.36,15.54-14.68,32.31-13.95,50.61a54.25,54.25,0,0,0,12.4,32.81A33,33,0,0,0,163.28,432q78,0,156.07-.13,85.13-.11,170.25-.32c14-.05,25.12-6.12,33.06-17.7,5.19-7.56,9-15.79,9.94-25,.92-8.51-.25-16.9-2.27-25.15-5.09-20.8-16.51-37.83-31.66-52.56-18.21-17.69-39.73-30.16-63.11-39.63-5.29-2.14-10.74-3.88-16.06-5.94a4,4,0,0,0-4.5.83,130.41,130.41,0,0,1-50.26,25.73c-69.53,18.46-140.32-19.07-163.38-86.62C175.27,129.09,222.81,46.22,301.89,30.31,374.47,15.7,445.31,61.94,460.26,134.65c8.43,41-.06,78.87-25.88,112.36-.36.48-.7,1-1.2,1.67,3.16,1.21,6.19,2.33,9.18,3.53,26.51,10.63,50.78,24.84,71.19,45.07,18.07,17.91,31.22,38.75,36.81,63.86,1.06,4.75,1.5,9.63,2.23,14.44.11.67.27,1.33.41,2ZM328.93,50c-61.88,0-112.28,50.29-112.34,112.1s50.27,112.34,111.83,112.39A112.41,112.41,0,0,0,440.86,162.26C440.87,100.51,390.52,50,328.93,50Z" transform="translate(-104.49 -27.62)"/></svg>
                            </a>
                        </router-link>
                        <router-link tag="li" :to="{name: 'cabinet'}" v-else>
                            <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448.51 426.18"><title>icon_lk</title><path d="M553,389.48c-1.08,4.89-1.81,9.89-3.31,14.65-3.57,11.27-8.4,22.08-16.72,30.64-11.7,12-26.16,18.57-43.11,18.6q-126.32.21-252.64.27c-24,0-48.05.3-72.08,0-23.72-.25-41.08-11-51.6-32.54-11.89-24.32-11.41-49-2.4-73.9,8.17-22.57,22.45-40.88,40.33-56.55,10.85-9.52,26.19-20.05,35.44-24.59l13.9,14.7c-5.09,3-10.34,5.94-15.39,9.18-18.84,12.09-35.16,26.8-46.82,46.17-9.36,15.54-14.68,32.31-13.95,50.61a54.25,54.25,0,0,0,12.4,32.81A33,33,0,0,0,163.28,432q78,0,156.07-.13,85.13-.11,170.25-.32c14-.05,25.12-6.12,33.06-17.7,5.19-7.56,9-15.79,9.94-25,.92-8.51-.25-16.9-2.27-25.15-5.09-20.8-16.51-37.83-31.66-52.56-18.21-17.69-39.73-30.16-63.11-39.63-5.29-2.14-10.74-3.88-16.06-5.94a4,4,0,0,0-4.5.83,130.41,130.41,0,0,1-50.26,25.73c-69.53,18.46-140.32-19.07-163.38-86.62C175.27,129.09,222.81,46.22,301.89,30.31,374.47,15.7,445.31,61.94,460.26,134.65c8.43,41-.06,78.87-25.88,112.36-.36.48-.7,1-1.2,1.67,3.16,1.21,6.19,2.33,9.18,3.53,26.51,10.63,50.78,24.84,71.19,45.07,18.07,17.91,31.22,38.75,36.81,63.86,1.06,4.75,1.5,9.63,2.23,14.44.11.67.27,1.33.41,2ZM328.93,50c-61.88,0-112.28,50.29-112.34,112.1s50.27,112.34,111.83,112.39A112.41,112.41,0,0,0,440.86,162.26C440.87,100.51,390.52,50,328.93,50Z" transform="translate(-104.49 -27.62)"/></svg>
                            </a>
                        </router-link>
                        <router-link tag="li" to="/izbrannoe">
                            <a href="" :class="returnBook.length ? 'active-cart' : null">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 361.33 348.7"><title>icon_izb</title><path d="M139,187.84c.31-1.27.57-2.56.95-3.8,3.15-10.21,10.48-15.77,20.64-17.29,30.69-4.59,61.42-8.88,92.15-13.22a4.56,4.56,0,0,0,3.84-2.8q20.55-41.22,41.2-82.39c4.8-9.58,12.7-14.39,23.36-13.83C331,55,337.71,60.6,342,69.18c7.6,15,15.11,30.14,22.66,45.22q9.12,18.22,18.21,36.47a4.41,4.41,0,0,0,3.75,2.64c15.4,2.14,30.78,4.4,46.16,6.6s30.65,4.46,46,6.54c11.84,1.61,20.49,10.23,21.44,22.11.61,7.72-2.59,14.1-8.07,19.39q-17.49,16.86-35,33.68c-8.22,7.9-16.41,15.84-24.68,23.7a11.12,11.12,0,0,1-14.66,1.1,10.81,10.81,0,0,1-1.08-16.8c8.81-8.56,17.71-17,26.57-25.55q16.64-16,33.22-32a3.46,3.46,0,0,0,1.1-2.48c-.08-.52-1.4-1.09-2.22-1.21q-40.37-5.88-80.74-11.64c-4.3-.62-8.61-1.17-12.9-1.85-8.67-1.37-14.81-6.11-18.72-14q-15.4-30.93-30.92-61.79c-3.47-6.92-6.91-13.86-10.45-20.74a3.73,3.73,0,0,0-2.12-1.94c-.54-.09-1.53,1.09-1.93,1.89-13.43,26.77-27,53.47-40.11,80.42-5,10.28-12.6,15.42-23.8,16.82-20.05,2.51-40,5.65-60,8.52-9.91,1.42-19.82,2.8-29.72,4.27-.82.12-2,.63-2.22,1.23s.41,1.75,1,2.32c21.63,20.87,43.12,41.88,65,62.44,8.5,8,11.23,16.81,9.09,28.18-5,26.6-9.39,53.3-14,80-.45,2.61-1,5.2-1.35,7.82-.11.83,0,2.1.56,2.49s1.79.12,2.52-.26q36.57-18.89,73.08-37.85c5.14-2.66,10.4-1.94,14,1.9,5.12,5.38,3.67,13.79-3.13,17.4-8.27,4.41-16.62,8.67-24.94,13q-24.37,12.64-48.77,25.29c-11.62,6-25.2,2.73-32.13-7.7-3.93-5.91-4.43-12.33-3.22-19.19,5.31-29.93,10.47-59.89,15.71-89.83a3.81,3.81,0,0,0-1.48-3.63Q188.7,248.08,163.64,224q-8.44-8.13-16.89-16.25a23.68,23.68,0,0,1-7.44-14.08,4.2,4.2,0,0,0-.31-.88Z" transform="translate(-139 -54.46)"/><path d="M383.14,346.75H380.6c-13.66,0-27.33,0-41,0a20.3,20.3,0,0,1-5.05-.53,10.74,10.74,0,0,1,.25-21.09,19.27,19.27,0,0,1,4.49-.44c13.73,0,27.46,0,41.19,0H383c0-.81.11-1.53.11-2.25,0-13.61,0-27.21,0-40.82a19.65,19.65,0,0,1,.52-4.85,11.12,11.12,0,0,1,10.92-8.47,11.25,11.25,0,0,1,10.55,9,18.88,18.88,0,0,1,.4,4.12q0,20.49,0,41v2.3h2.34c13.85,0,27.71,0,41.57,0a18.73,18.73,0,0,1,4.67.5,11,11,0,0,1,8.53,11.58c-.39,4.92-5,9.31-10.4,9.87-1.13.11-2.27.12-3.4.12H405.55v2.38c0,13.67,0,27.34,0,41a17.21,17.21,0,0,1-.7,5,11,11,0,0,1-11.63,7.95,11.64,11.64,0,0,1-10-10.54c-.09-1-.08-2-.08-3q0-20.11,0-40.25Z" transform="translate(-139 -54.46)"/></svg>
                            </a>
                        </router-link>
                        <router-link tag="li" to="/korzina">
                            <a href="" v-bind:class="getCartCount ? 'active-cart' : null">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 510.2 418.41"><path d="M552.72,93.5c-.77,3.55-1.1,7.26-2.39,10.61q-5.24,13.55-11.15,26.83-27,60.36-54.24,120.61a187.52,187.52,0,0,1-9.51,17.29c-6.51,11.1-16.9,15.39-29.17,16.13-3.11.19-6.24.2-9.36.2H210.66a62,62,0,0,0,8,17c7.14,10.51,16.82,15.78,29.82,15.75,64.81-.18,129.63-.09,194.44-.08a20.25,20.25,0,0,1,4.13.26,10.44,10.44,0,0,1,8.35,11.25,10.59,10.59,0,0,1-9.85,9.71c-1,.09-2.09.05-3.13.05-64.37,0-128.75-.15-193.13.08-21.91.08-38-9.46-49.64-27.46-6.72-10.41-10-22.12-13.3-33.94-8.74-31.45-17.85-62.8-27-94.14C148.26,145.41,136.94,107.22,125.7,69c-2.74-9.34-13.21-17.12-23.47-17.18-16-.1-32.1,0-48.15,0-5.21,0-9-2.42-10.77-6.68-2.75-6.75,2.06-14.52,9.38-14.52,21.17,0,42.34,0,63.49.62,5.3.14,10.77,1.88,15.75,3.89,7.21,2.92,11.72,8.75,13.81,16.27q29.14,104.75,58.18,209.5c.69,2.49,1.68,3.19,4.2,3.18q114.66-.1,229.31-.06c2.78,0,5.55-.18,8.32-.25,5.67-.14,10-2.41,12.64-7.61,5.07-10,10.53-19.91,15.16-30.16q27.33-60.5,54.14-121.22a48.89,48.89,0,0,0,3.56-13.48c.89-7-.71-8.5-7.75-8.55s-14.05.08-21.08.09q-58.95.06-117.91.09c-22.73,0-45.46-.08-68.19-.1L200,82.7c-6.46,0-10.43-2.71-11.84-8a10.46,10.46,0,0,1,8.09-13,25,25,0,0,1,4.66-.31q132.09.07,264.19.19c18.74,0,37.48-.22,56.22-.14a52.19,52.19,0,0,1,12.6,1.4c10.22,2.63,16.16,9.56,18.27,19.84.14.65.37,1.29.55,1.94Z" transform="translate(-42.53 -30.59)"/><path d="M437.67,449c-4.33-1.14-8.81-1.9-13-3.5A49.57,49.57,0,0,1,437.16,350c26.07-3,50.22,15.1,54.56,40.83,4.41,26.13-12.49,51.39-38.13,57-1.83.4-3.67.78-5.51,1.17Zm-24.18-49.62a29.39,29.39,0,0,0,29.34,29.25c15.94-.07,29.24-13.38,29.16-29.19a29.25,29.25,0,1,0-58.5-.06Z" transform="translate(-42.53 -30.59)"/><path d="M235.67,449c-5.22-1.5-10.69-2.42-15.61-4.6-20.4-9-31.76-30.29-28.6-52.74,2.94-20.83,20.25-38.15,41.44-41.46,27.06-4.22,53,14.75,56.84,41.67A49.75,49.75,0,0,1,247,448.55a8.76,8.76,0,0,0-1.46.45Zm4.85-78.92a29.28,29.28,0,1,0,.22,58.55c15.84-.11,29.07-13.29,29.09-29A29.38,29.38,0,0,0,240.52,370.08Z" transform="translate(-42.53 -30.59)"/><path class="cls-1" d="M413.49,399.38a29.25,29.25,0,1,1,58.5.06c.08,15.81-13.22,29.12-29.16,29.19A29.39,29.39,0,0,1,413.49,399.38Z" transform="translate(-42.53 -30.59)"/><path class="cls-1" d="M240.52,370.08a29.38,29.38,0,0,1,29.31,29.55c0,15.71-13.25,28.89-29.09,29a29.28,29.28,0,1,1-.22-58.55Z" transform="translate(-42.53 -30.59)"/></svg>
                            </a>
                            <span v-if="getCartCount">
                                {{getCartCount}}
                            </span>
                        </router-link>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="menu-wrap" v-if="menuHide" @mouseleave="unHoverTopMenu()">
            <div class="menu-middle">
                <ul class="container genders" v-bind:class="returnWidth" >
                    <li v-for="(gen, k) in $store.getters.topMenu"
                        :key="k"
                    >
                        <router-link :to="{name: 'gender', params: {gender: gen.url}}">
                            <span v-if="media.wind > media.tablet" @mouseover="hoverTopMenu(gen.title, k)" :class="gen.hover ? 'active-top-menu' : 'unactive-top-menu'" @click="closeMenu()">{{gen.title}}</span>
                            <span v-else @click="ClickShowCategories(gen.title, k)" :class="gen.hover ? 'active-top-menu' : 'unactive-top-menu'">{{gen.title}}</span>
                        </router-link>
                    </li>
                </ul>
            </div>
            <div class="menu-bottom" v-if="showMenu">
                <ul class="menu-categories" v-if="categoriesHide">
                    <li
                        v-for="(categ, value, i) in categories"
                        :key="i+'c'"
                        :class="categ[0].hover ? 'active-catg' : null"
                        @mouseleave="categ[0].hover = false"
                    >
                        <router-link v-if="value === 'Распродажа'" :to="{name: 'gender', params: {gender: categ[0].sex_alias}, query: {sale: 'true', page: '1'}}" :replace="false" :append="false">
                            <span v-if="media.wind > media.tablet" @mouseover="showDepartment(value, categories, categ)" :class="value === 'Распродажа' ? 'sale' : null" @click="closeMenu()">{{value}}</span>
                            <span v-else @click="ClickShowDepartments(categ)" :class="value === 'Распродажа' ? 'sale' : null">{{value}}</span>
                        </router-link>
                        <router-link v-else :to="{name: 'category', params: {gender: categ[0].sex_alias, category: categ[0].categories_alias}}" >
                            <span v-if="media.wind > media.tablet" @mouseover="showDepartment(value, categories, categ)" @click="closeMenu()">{{value}}</span>
                            <span v-else @click="ClickShowDepartments(categ)">{{value}}</span>
                        </router-link>
                    </li>
                </ul>
                <ul class="menu-departments" v-if="departmentsHide" @mouseover="hoverCategories()" @mouseleave="getChosenCategory !== null ? categories[getChosenCategory][0].hover = false : true">
                    <li v-if="media.wind <= media.tablet" class="back-to-categories" @click="backToCategories()">
                        <router-link :to="{name: 'category', params: {gender: getDepartments[0].sex_alias, category: getDepartments[0].categories_alias}}">{{getDepartments[0].category}}</router-link>
                    </li>
                    <li  v-for="(depart, d) in getDepartments" v-if="depart.department !== null" :key="d+'d'" @click="closeMenu()">
                        <router-link :to="{name: 'department', params: {gender: depart.sex_alias, category: depart.categories_alias, department: depart.departments_alias}}" >{{depart.department}}</router-link>
                    </li>
                </ul>
            </div>
        </div>
        <vue-progress-bar v-if="media.wind > media.tablet"></vue-progress-bar>
    </nav>
</template>

<script>
    export default {
        name: "Header",
        data:() => ({
            topMenuLength: null,
            showMenu: false,
            departments: null,
            chosenCatg: null,
            categories: null,
            chosenGender: null,
            cabinet: false,

            // Для скрытия главного меню
            menuHide: true,

            // Сркываем подкатегории
            departmentsHide: true,

            // Скрываем категории
            categoriesHide: true,

        }),
        beforeMount() {
            this.$Progress.start();
        },
        methods: {
            // Наводим на главное меню
            hoverTopMenu(genderTitle, k){

                // Получаем категории
                this.categories = this.$store.getters.lastMenu[genderTitle];

                // Полуаем подкатегории для катергории по номер 1
                for (let i in this.categories) {
                    this.departments = this.categories[i];
                    break;
                }

                // Показываем меню
                this.showMenu = true;

                // Делаем hover на topMenu
                for (let gen in this.$store.getters.topMenu) {

                    this.$store.getters.topMenu[gen].hover = false;
                }

                this.$store.getters.topMenu[k].hover = true;
            },

            // Уводим с главного меню
            unHoverTopMenu(){

                for (let gen in this.$store.getters.topMenu) {

                    this.$store.getters.topMenu[gen].hover = false;
                }
                this.showMenu = false;
            },

            // Показываем подкатегории
            showDepartment(k, menu, categ){
                this.departments = categ;
                categ[0].hover = true;
                this.chosenCatg = k;
            },

            // Оставляем hover на категориях, если переходим на поле с подкатегориями
            hoverCategories(){
                if (this.chosenCatg !== null) this.categories[this.chosenCatg][0].hover = true
            },

            closeMenu(){
                if (this.media.wind > this.media.tablet) {
                    this.showMenu = false;
                }
            },

            // МОБИЛКА
            // Открываем меню в мобилке
            EatHamburger(){
                this.menuHide = !this.menuHide;
            },

            // Открываем гендеров
            ClickShowCategories(genderTitle, k){
                // Получаем категории
                this.categories = this.$store.getters.lastMenu[genderTitle];

                // Показываем меню
                this.showMenu = !this.showMenu;

                // Скрываем подкатегории
                this.departmentsHide = false;

                // Открываем категории
                this.categoriesHide = true;
            },

            // Открываем подкатегории
            ClickShowDepartments(categ){
                // Показываем подкатегории
                this.departments = categ;
                this.departmentsHide = true;

                // Скрываем категории, чтобы открыть подкатегории
                this.categoriesHide = false;
            },

            backToCategories(){
                // Скрываем подкатегории
                this.departmentsHide = false;

                // Открываем категории
                this.categoriesHide = true;
            }
        },
        // Получаем меню
        created(){
            if (!this.$store.getters.lastMenu.length && !this.$store.getters.topMenu.length) this.$store.dispatch('getMenuData');
            this.$Progress.finish();

            // @media tablet 768px
            // Скрываем меню
            if (this.media.wind <= this.media.tablet) {
                this.menuHide = !this.menuHide;
            }
        },
        // Котролируем ширину меню
        updated() {
            this.topMenuLength = this.$store.getters.topMenu.length;
        },
        computed: {
            // Следим за шириной меню
            getTopMenuLength(){
                return this.topMenuLength;
            },

            // Отдаем ширину меню
            returnWidth(){
                let width = {
                    2: 'width-300',
                    3: 'width-500',
                    4: 'width-600',
                    5: 'width-700',
                    6: 'width-800',
                    7: 'width-900',
                    8: 'width-1000'
                };
                let resultWidth = null;

                for (let wd in width){

                    if (this.topMenuLength == wd) resultWidth = width[wd];
                }

                if (resultWidth === null) {
                    resultWidth = 'width-default';
                }
                return resultWidth;
            },

            // Следим за изменением выбранной категории
            getChosenCategory(){
                return this.chosenCatg;
            },

            // Следим за подкатегориями
            getDepartments(){
                return this.departments;
            },

            getCartCount: {
                get(){
                    return this.$store.getters.countCart;
                },
                set(val){
                    console.log(val, 'countCart')
                    return val;
                }
            },
            isLoggedIn(){
                return this.$store.getters.isLoggedIn;
            },
            media(){
                return this.$store.getters.media;
            },
            returnBook(){
                return this.$store.getters.bookmarks;
            }
        },
        watch: {
            categories(val){
                this.categories = val;
            },
            // isLoggedIn(newVal){
            //
            // }
        },

    }
</script>
<!--<template>-->
<!--  <nav>-->
<!--      <div class="menu-top">-->
<!--          <ul class="grid-nav-top container">-->
<!--              <li>-->
<!--                  <form class="nav-search">-->
<!--                      <div class="search">-->
<!--                          <input type="search" id="search" placeholder="Поиск">-->
<!--                          <label for="search"><img src="../../img/search.png" alt=""></label>-->
<!--                      </div>-->
<!--                  </form>-->
<!--              </li>-->
<!--              <router-link class="flexin-center logo" tag="li" to="/"><a href="#">Lappinalle</a></router-link>-->
<!--              <li class="nav-icons">-->
<!--                  <ul class="nav-icons-items">-->
<!--                      <router-link tag="li" to="/cabinet"><a href=""><img src="../../img/cabinet.png" alt=""></a></router-link>-->
<!--                      <router-link tag="li" to="/bookmark"><a href=""><img src="../../img/bookmark.png" alt=""></a></router-link>-->
<!--                      <router-link tag="li" to="/cart"><a href=""><img src="../../img/cart.png" alt=""></a></router-link>-->
<!--                  </ul>-->
<!--              </li>-->
<!--          </ul>-->
<!--      </div>-->
<!--      <div class="menu-wrap" @mouseleave="unHoverTopMenu()">-->
<!--          <div class="menu-middle">-->
<!--              <ul class="container genders" v-bind:class="returnWidth" >-->
<!--                  <router-link-->
<!--                          v-for="(link, i) in getTopMenu"-->
<!--                      :key="i"-->
<!--                      tag="li"-->
<!--                      :to="link.url"-->
<!--                      :exact="link.exact"-->
<!--                  >-->
<!--                      <a href="#" @mouseover="hoverTopMenu(link.title, getTopMenu, i)" :class="link.hover ? 'active-top-menu': 'unactive-top-menu'">{{link.title}}</a>-->
<!--                  </router-link>-->
<!--              </ul>-->
<!--          </div>-->
<!--          <div class="menu-bottom" v-if="showMenu">-->
<!--              <ul @mouseover="hoverMenu()" class="menu-categories" v-if="getTopMenu.length">-->
<!--                  <router-link v-for="(value, catg, i) in getBottomMenu[getChosenCatg]"-->
<!--                               :key="i"-->
<!--                               tag="li"-->
<!--                               active-class="active"-->
<!--                               :to="getBottomMenu[getChosenCatg][catg][0].categories_alias"-->
<!--                               :exact='catg.exact'-->
<!--                               :class="getBottomMenu[getChosenCatg][catg][0].hover ? 'active-catg' : null"-->
<!--                  >-->
<!--                      <a href="#" @mouseover="mouseOverDept(value, getBottomMenu[getChosenCatg], catg)" @mouseleave="getBottomMenu[getChosenCatg][catg][0].hover = false" :class="catg === 'Распродажа' ? 'sale' : null">{{catg}}</a>-->
<!--                  </router-link>-->
<!--              </ul>-->
<!--              <ul class="menu-departments" @mouseover="doHoverCatg()" v-if="returnDepart.length" @mouseleave="getBottomMenu[getChosenCatg][hoverCatg][0].hover = false">-->
<!--                  <router-link-->
<!--                      v-for="(valueIn, k) in returnDepart"-->
<!--                      :key="k"-->
<!--                      tag="li"-->
<!--                      active-class="active"-->
<!--                      :to="valueIn.departments_alias"-->
<!--                      :exact='valueIn.exact'-->
<!--                  >-->
<!--                      <a href="#">{{valueIn.department}}</a>-->
<!--                  </router-link>-->
<!--              </ul>-->
<!--          </div>-->
<!--          <div class="menu-bottom" v-else>-->

<!--          </div>-->
<!--      </div>-->
<!--  </nav>-->
<!--</template>-->

<!--<script>-->
<!--export default {-->
<!--    name: "Header",-->
<!--    data:() => ({-->
<!--        lastMenu: null,-->
<!--        topMenuLength: null,-->
<!--        showMenu: false,-->
<!--        departments: null,-->
<!--        hoverCatg: null,-->
<!--        chosenCatg: null-->

<!--    }),-->
<!--    methods: {-->
<!--        // Наводим на главное меню-->
<!--        hoverTopMenu(item, topMenu, i){-->
<!--            // Получаем меню категории для выбранного айтема меню-->
<!--            this.chosenCatg = item;-->

<!--            // Полуаем подкатегории для катергории по номер 1-->
<!--            for (let i in this.getBottomMenu[item]) {-->
<!--                this.departments = this.getBottomMenu[item][i];-->
<!--                break;-->
<!--            }-->
<!--            console.log(this.departments)-->
<!--            // Показываем меню-->
<!--            this.showMenu = true;-->

<!--            // Делаем hover на topMenu-->
<!--            for (let cat in topMenu) {-->

<!--                topMenu[cat].hover = false;-->
<!--            }-->
<!--            topMenu[i].hover = true;-->

<!--        },-->

<!--        // Уюираем мышку с лавного меню-->
<!--        unHoverTopMenu(){-->
<!--            this.showMenu = false;-->

<!--            for (let cat in this.getTopMenu) {-->

<!--                this.getTopMenu[cat].hover = false;-->
<!--            }-->
<!--        },-->

<!--        // Показывае меню с категориями и подкатегориями-->
<!--        hoverMenu(){-->
<!--            this.showMenu = true;-->
<!--        },-->

<!--        // Показываем категории-->
<!--        mouseOverDept(k, menu, catg){-->
<!--            this.departments = k;-->
<!--            this.hoverCatg = catg;-->
<!--            menu[catg][0].hover = true;-->
<!--        },-->

<!--        doHoverCatg(){-->
<!--            this.lastMenu[this.hoverCatg][0].hover = true;-->
<!--        }-->
<!--    },-->
<!--    // Получаем меню-->
<!--    created(){-->
<!--        if (!this.$store.getters.lastMenu.length && !this.$store.getters.topMenu.length) this.$store.dispatch('getMenuData');-->
<!--        // console.log(this.lastMenu)-->
<!--    },-->
<!--    // Котролируем ширину меню-->
<!--    updated() {-->
<!--        this.topMenuLength = this.getTopMenu.length;-->
<!--        console.log(1)-->
<!--    },-->
<!--    computed: {-->
<!--        // Следим за шириной меню-->
<!--        getTopMenuLength(){-->
<!--            return this.topMenuLength;-->
<!--        },-->

<!--        // Отдаем ширину меню-->
<!--        returnWidth(){-->
<!--            let width = {-->
<!--                2: 'width-300',-->
<!--                3: 'width-500',-->
<!--                4: 'width-600',-->
<!--                5: 'width-700',-->
<!--                6: 'width-800',-->
<!--                7: 'width-900',-->
<!--                8: 'width-1000'-->
<!--            };-->
<!--            let resultWidth = null;-->

<!--            for (let wd in width){-->

<!--                if (this.topMenuLength == wd) resultWidth = width[wd];-->
<!--            }-->

<!--            if (resultWidth === null) {-->
<!--                resultWidth = 'width-default';-->
<!--            }-->
<!--            return resultWidth;-->
<!--        },-->

<!--        // Отдаем категории-->
<!--        returnDepart(){-->
<!--            return this.departments;-->
<!--        },-->

<!--        // Отдаем категории и подкатегории-->
<!--        getBottomMenu(){-->
<!--          return this.$store.getters.lastMenu;-->
<!--        },-->

<!--        // Отдаем мальчки, девочики ..-->
<!--        getTopMenu(){-->
<!--            return this.$store.getters.topMenu;-->
<!--        },-->

<!--        getChosenCatg(){-->
<!--            return this.chosenCatg;-->
<!--        }-->
<!--    }-->
<!--}-->
<!--</script>-->

<style lang = "scss">

</style>
