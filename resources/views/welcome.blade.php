<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')

 <!-- Alpine Plugins -->
 <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
  <!-- Alpine Core -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <!-- tailwind -->
  <link href="/dist/output.css" rel="stylesheet">


</head>

<body>
	

	
  <div class="flex justify-center mt-16">
    <div class="w-3/4 px-6 py-4 bg-white rounded-md shadow-xl">
      <h2 class="my-2 text-3xl ">Todo Application</h2>


          <!--THIS ATTRIBUTE USE TO METHODS ALPINEJS -->

      <div x-data="
      {
         tasks:$persist([]),
         remain_task_count:0,
         current:'',
         active_tab:'all',
         message_state:false,
         message_duration:4000,
         add_item(){
           this.tasks.push(
             {
               task:this.current,
               is_complete:false
             }
           );
           this.current='';
           this.message_state=true;
           setTimeout(()=>{
             this.message_state=false
           },this.message_duration)
         },
         update_remain_count(){
           this.remain_task_count=0
           this.tasks.map((item)=>{
              if(!item.is_complete){
               this.remain_task_count++;
              }
           })
         }
      }"
     
     
     x-effect="update_remain_count">


                        <div x-cloak x-show="message_state" class="absolute inset-0 h-10 px-3 py-2 text-white bg-emerald-600">
                        &#127881;Congratulations! You've successfully added a new task to your to-do list &#128221;.
                                                                                                                    </div>


                        
                                         <!--THIS FORM METHOD-->
         <form class="flex " @submit.prevent @submit="add_item">
                        <input type="text" required
                        class="w-full px-5 py-2 border-t border-b outline-none border-s rounded-s-md focus:border-blue-600 focus:border-2"
                        x-model="current" placeholder="Enter the Task">
                    <button class="bg-[#3563E9] text-white px-10 font-semibold py-2 rounded-e">Add</button>
             </form>

                                    <!-- THIS FILTER BUTTONS -->

        <div class="text-[#3563E9] mt-4 flex gap-2">
                    <button @click="active_tab='all'" class="px-5 py-1 border-[#3563E9] rounded"
                        :style="active_tab=='all'?'background-color:#3563E9 ;color:white': ''">All</button>
                    <button @click="active_tab='completed'" class="px-5 py-1 border-[#3563E9] rounded"
                        :style="active_tab=='completed'?'background-color:#3563E9;color:white':''">Completed</button>
                    <button @click="active_tab='active'" class="px-5 py-1 border-[#3563E9] rounded"
                        :style="active_tab=='active'?'background-color:#3563E9;color:white' : ''">Active</button>
            </div>


        <div class="my-2 text-xl">Your Tasks</div>
                            <template x-for="item in tasks">
                                                <!-- THIS IS SHOW TASK LIST -->
                        <div x-show="active_tab=='all'?true:active_tab=='completed'?item.is_complete:!item.is_complete;"
                            class="flex items-center justify-between gap-3 py-1 my-2"
                            :style="item.is_complete?'text-decoration:line-through;opacity:0.4':''">
                            <div>

                                    <!-- THIS  IS UPDATE IN TASKS STATUS -->
              <input @change="item.is_complete=!item.is_complete" type="checkbox" name="" id=""
                class="w-5 h-5 p-2 rounded-full accent-green-900" ><span x-text="item.task" class="text-xl ms-2"></span>
                                                                                                    </div>


                                                    <!-- DELETE TASKS -->
                                        <svg @click="tasks.splice(tasks.indexOf(item),1)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>

                                                                                                                    </div>
                                                                                                                 </template>
        
                                             <!-- TASK COUNT -->
    <div class="flex justify-between text-gray-600" x-data>
          <div>Total Tasks: <span class="text-gray-800" x-text="tasks.length"></span></div>
          <div>Remaining Tasks: <span class="text-gray-800" x-text="remain_task_count"></span></div>
                                                                                       </div>
                                                                                                </div>
                                                                                                        </div>
                                                                                                                  </div>
</body>
</html>
