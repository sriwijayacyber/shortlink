import axios from "axios";
import { useState } from "react";
import { error } from "@/utils/toast";
import { LinkItemProps } from "@/types";
import { Button, Dialog } from "@material-tailwind/react";
import Delete from "../Icons/Delete";

interface Props {
   block: LinkItemProps;
   setLink: (state: any) => void;
}

const DeleteBlock = (props: Props) => {
   const { block, setLink } = props;
   const [open, setOpen] = useState(false);

   const handleOpen = () => {
      setOpen((prev) => !prev);
   };

   const deleteHandler = async () => {
      const res = await axios.delete(
         `/bio-links/customize/block/delete/${block.id}`
      );

      if (res.data.success) {
         setOpen(false);
         setLink(res.data.link);
      } else if (res.data.error) {
         error(res.data.error);
      }
   };

   return (
      <>
         <Delete
            onClick={handleOpen}
            className="w-5 h-5 cursor-pointer text-red-500 ml-2"
         />

         <Dialog
            size="xs"
            open={open}
            handler={handleOpen}
            className="px-6 py-10 max-h-[calc(100vh-80px)] overflow-y-auto text-gray-800"
         >
            <h6 className="text-red-500 text-center text-xl mb-10">
               Are you sure to delete?
            </h6>
            <div className="flex items-center justify-center">
               <Button
                  color="blue"
                  variant="gradient"
                  onClick={handleOpen}
                  className="py-2 font-medium capitalize text-base mr-6"
               >
                  <span>Cancel</span>
               </Button>
               <Button
                  color="red"
                  variant="gradient"
                  className="py-2 font-medium capitalize text-base"
                  onClick={deleteHandler}
               >
                  <span>Delete</span>
               </Button>
            </div>
         </Dialog>
      </>
   );
};

export default DeleteBlock;
