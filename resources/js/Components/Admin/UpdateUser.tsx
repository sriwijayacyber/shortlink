import axios from "axios";
import EditPen from "../Icons/EditPen";
import { useForm, usePage } from "@inertiajs/react";
import { FormEventHandler, useState } from "react";
import { PageProps, PaginationProps, UserProps } from "@/types";
import { Button, Dialog, IconButton } from "@material-tailwind/react";
import { error, success } from "@/utils/toast";
import InputDropdown from "../InputDropdown";

interface Props {
   user: UserProps;
   users: PaginationProps;
   setUsers: (res: PaginationProps) => void;
}

const UpdateUser = (props: Props) => {
   const page = usePage<PageProps>();
   const { app, input } = page.props.translate;
   const { user, users, setUsers } = props;
   const [open, setOpen] = useState(false);
   const [statusError, setStatusError] = useState<string | null>(null);

   const handleOpen = () => {
      setOpen((prev) => !prev);
   };

   const { data, setData } = useForm({
      status: "",
   });

   const submit: FormEventHandler = async (e) => {
      e.preventDefault();
      setStatusError(null);

      try {
         const res = await axios.put(`/admin/users/update/${user.id}`, data);
         if (res.data.error) {
            error(res.data.error);
         } else if (res.data.success && res.data.user) {
            handleOpen();
            success(res.data.success);

            const updatedUsers = users.data.map((item) => {
               return item.id === res.data.user.id
                  ? { ...item, status: res.data.user.status }
                  : item;
            });

            setUsers({
               ...users,
               data: updatedUsers,
            });
         }
      } catch (error: any) {
         setStatusError("Something was wrong!. Try again few moment later.");
      }
   };

   return (
      <>
         <IconButton
            variant="text"
            color="white"
            onClick={handleOpen}
            className="w-7 h-7 rounded-full bg-blue-50 hover:bg-blue-50 active:bg-blue-50 text-blue-500"
         >
            <EditPen className="h-4 w-4" />
         </IconButton>

         <Dialog
            size="sm"
            open={open}
            handler={handleOpen}
            className="p-6 max-h-[calc(100vh-80px)] overflow-y-auto text-gray-800"
         >
            <div className="flex items-center justify-between mb-6">
               <p className="text-xl font-medium">{app.update_user}</p>
               <span
                  onClick={handleOpen}
                  className="text-3xl leading-none cursor-pointer"
               >
                  ×
               </span>
            </div>

            <form onSubmit={submit}>
               <InputDropdown
                  required
                  fullWidth
                  name="status"
                  error={statusError as string}
                  defaultValue={user.status}
                  itemList={[
                     { key: "Active", value: "active" },
                     { key: "Deactive", value: "deactive" },
                  ]}
                  onChange={(e: any) => setData("status", e.value)}
                  label={input.user_status}
               />

               <div className="flex justify-end mt-8">
                  <Button
                     color="red"
                     variant="text"
                     onClick={handleOpen}
                     className="py-2 font-medium capitalize text-base mr-2"
                  >
                     <span>{app.cancel}</span>
                  </Button>
                  <Button
                     type="submit"
                     color="blue"
                     variant="gradient"
                     className="py-2 font-medium capitalize text-base"
                  >
                     <span>{app.save_changes}</span>
                  </Button>
               </div>
            </form>
         </Dialog>
      </>
   );
};

export default UpdateUser;
