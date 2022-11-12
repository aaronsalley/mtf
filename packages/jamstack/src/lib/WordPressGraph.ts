export const API_URL =
  process.env.SENTRY_ENVIRONMENT !== 'development'
    ? typeof window !== 'undefined'
      ? process.env.NEXT_PUBLIC_API_URL
      : process.env.API_URL
    : typeof window !== 'undefined'
    ? 'http://aarons-macbook-pro.local:32769'
    : 'http://cms';

// metaKeywords,
// focuskw,
// canonical,
// cornerstone,
// opengraphPublishedTime,
// opengraphAuthor,
export const SEO = `seo {
  title,
  metaDesc,
  metaRobotsNofollow,
  metaRobotsNoindex,
  readingTime,
  opengraphType,
  opengraphTitle,
  opengraphDescription,
  opengraphUrl,
  opengraphSiteName,
  opengraphModifiedTime,
  opengraphImage {
    mediaItemUrl,
    mediaDetails {
      width,
      height
    },
    mimeType,
  },
  opengraphPublisher,
  twitterTitle,
  twitterDescription,
  twitterImage {
    mediaItemUrl,
  },
  schema {
    raw
  }
}`;

export const MENUITEMS = `menuItems(where: {location: MEGA, parentId: ""}, first: 1000) {
  nodes {
    label,
    title,
    target,
    path,
    parentId,
    childItems {
      nodes {
        label,
        title,
        target,
        path,
        parentId,
      }
    }
  }
}`;
export const NAVITEMS = `navItems: menuItems(where: {location: NAV, parentId: ""}, first: 1000) {
  nodes {
    label,
    title,
    target,
    path,
  }
}`;
export const MAKERS = `mediaItems(where: {mediaCategory: "maker"}, first: 50) {
  nodes {
    title,
    mediaType,
    mediaItemUrl,
    altText,
  }
}`;
export const PAGES = `pages(where: {status: PUBLISH}, first: 100) {
  nodes {
    uri,
    title,
    content,
    excerpt,
    featuredImage {
      node {
        mediaType,
        mediaItemUrl,
        altText,
      }
    },
    contentTypeName,
    ${SEO},
  }
}`;
export const EVENTS = `events(where: {status: PUBLISH}, first: 100) {
  nodes {
    id,
    title,
    excerpt,
    content,
    isAllDay,
    ticketPrice,
    datetimeEnd,
    datetimeStart,
    eventURL,
    eventCategories {
      nodes {
        name,
      },
    },
    tags {
      nodes {
        name,
      },
    },
    uri,
    slug,
    featuredImage {
      node {
        mediaType,
        mediaItemUrl,
        altText,
      }
    },
    ${SEO},
  },
},
seo {
  contentTypes {
    event {
      title,
      metaDesc,
      schemaType,
      schema {
        raw
      }
    }
  }
}`;
export const POSTS = `posts(where: {status: PUBLISH}) {
  nodes {
    date,
    title,
    uri,
    content,
    excerpt,
    contentTypeName,
    ${SEO},
  }
},
seo {
  contentTypes {
    event {
      title,
      metaDesc,
      schemaType,
      schema {
        raw
      }
    }
  }
}`;
export const SITE = `allSettings {
  siteName:generalSettingsTitle,
  metaDescription:generalSettingsDescription,
}`;

export const getEvents = async () => {
  try {
    const GraphQLQuery = {
      // operationName: 'getAllContent',
      query: `query {
        ${EVENTS},
      }`.replaceAll(/\s/gi, ''),
      variables: {},
    };

    const res = await fetch(API_URL + `/graphql`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(GraphQLQuery),
      // mode: 'no-cors',
    });

    const json = await res.json();
    if (json.errors) throw JSON.stringify(json.errors);

    json.data['title'] = 'Work in progress';

    return json.data;
  } catch (error: any) {
    console.error('Fetch error: ', error.message);

    return {
      notFound: true,
    };
  }
};

export const getPosts = async () => {
  try {
    const GraphQLQuery = {
      // operationName: 'getContent',
      query: `query {
        ${POSTS},
      }`.replaceAll(/\s/gi, ''),
      variables: {},
    };

    const res = await fetch(API_URL + `/graphql`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(GraphQLQuery),
      // mode: 'no-cors',
    });

    const json = await res.json();
    if (json.errors) throw JSON.stringify(json.errors);

    return json.data;
  } catch (error: any) {
    console.error('Fetch error: ', error.message);

    return {
      notFound: true,
    };
  }
};
