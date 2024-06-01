import { SVGProps } from "react-html-props";

const Chat = (props: SVGProps) => {
   return (
      <svg
         width="16"
         height="16"
         viewBox="0 0 16 16"
         fill="none"
         xmlns="http://www.w3.org/2000/svg"
         {...props}
      >
         <path
            d="M5.64178 7.87109C5.5853 7.83206 5.50459 7.83341 5.44739 7.88425C5.38589 7.93892 5.37743 8.03792 5.43661 8.10492C6.06493 8.80687 6.98101 9.25 7.99724 9.25C9.01385 9.25 9.93023 8.80654 10.5586 8.10414L5.64178 7.87109ZM5.64178 7.87109L5.66476 7.89667C6.23914 8.53595 7.06681 8.9375 7.9945 8.9375C8.92112 8.9375 9.75211 8.53676 10.3247 7.8962L5.64178 7.87109ZM6.51514 4.67233C6.58546 4.74266 6.62497 4.83804 6.62497 4.9375C6.62497 5.03696 6.58546 5.13234 6.51514 5.20266C6.44481 5.27299 6.34943 5.3125 6.24997 5.3125C6.15052 5.3125 6.05513 5.27299 5.98481 5.20266C5.91448 5.13234 5.87497 5.03696 5.87497 4.9375C5.87497 4.83804 5.91448 4.74266 5.98481 4.67233C6.05513 4.60201 6.15052 4.5625 6.24997 4.5625C6.34943 4.5625 6.44481 4.60201 6.51514 4.67233ZM10.0151 4.67234C10.0855 4.74266 10.125 4.83804 10.125 4.9375C10.125 5.03696 10.0855 5.13234 10.0151 5.20266C9.94481 5.27299 9.84943 5.3125 9.74997 5.3125C9.65052 5.3125 9.55513 5.27299 9.48481 5.20267C9.41448 5.13234 9.37497 5.03696 9.37497 4.9375C9.37497 4.83804 9.41448 4.74266 9.48481 4.67234C9.55513 4.60201 9.65052 4.5625 9.74997 4.5625C9.84943 4.5625 9.94481 4.60201 10.0151 4.67234Z"
            fill="currentColor"
            stroke="currentColor"
         />
         <path
            opacity="0.4"
            d="M1 2.75C1 1.78477 1.78477 1 2.75 1H13.25C14.2152 1 15 1.78477 15 2.75V10.625C15 11.5902 14.2152 12.375 13.25 12.375H9.45742L6.075 14.9125C5.94375 15.0109 5.76602 15.0273 5.61562 14.9535C5.46523 14.8797 5.375 14.7293 5.375 14.5625V12.375H2.75C1.78477 12.375 1 11.5902 1 10.625V2.75ZM6.25 5.8125C6.48206 5.8125 6.70462 5.72031 6.86872 5.55622C7.03281 5.39212 7.125 5.16956 7.125 4.9375C7.125 4.70544 7.03281 4.48288 6.86872 4.31878C6.70462 4.15469 6.48206 4.0625 6.25 4.0625C6.01794 4.0625 5.79538 4.15469 5.63128 4.31878C5.46719 4.48288 5.375 4.70544 5.375 4.9375C5.375 5.16956 5.46719 5.39212 5.63128 5.55622C5.79538 5.72031 6.01794 5.8125 6.25 5.8125ZM9.75 5.8125C9.98206 5.8125 10.2046 5.72031 10.3687 5.55622C10.5328 5.39212 10.625 5.16956 10.625 4.9375C10.625 4.70544 10.5328 4.48288 10.3687 4.31878C10.2046 4.15469 9.98206 4.0625 9.75 4.0625C9.51794 4.0625 9.29538 4.15469 9.13128 4.31878C8.96719 4.48288 8.875 4.70544 8.875 4.9375C8.875 5.16956 8.96719 5.39212 9.13128 5.55622C9.29538 5.72031 9.51794 5.8125 9.75 5.8125ZM5.11523 7.51055C4.84453 7.75117 4.82266 8.1668 5.06328 8.4375C5.78242 9.24141 6.83242 9.75 7.99727 9.75C9.16211 9.75 10.2121 9.24141 10.9313 8.4375C11.1719 8.1668 11.15 7.75391 10.8793 7.51055C10.6086 7.26719 10.1957 7.2918 9.95234 7.5625C9.47109 8.10117 8.77383 8.4375 7.99453 8.4375C7.21523 8.4375 6.5207 8.10117 6.03672 7.5625C5.79609 7.2918 5.38047 7.26992 5.10977 7.51055H5.11523Z"
            fill="currentColor"
         />
      </svg>
   );
};

export default Chat;
